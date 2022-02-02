<?php

// koneksi ke database
// ("localhost", "username", "password", "nama database")
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query){
    global $conn;
$result = mysqli_query($conn, $query);
$rows = [];
while( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
}
return $rows;
}


function tambah($data){
    global $conn;
    // htmlspecialchars     adalah untuk mengetahui coding yang akan hack web kalian atau saya dll intinya untuk mengamankan web tersebut
      $nama = htmlspecialchars($data["nama"]);
      $nim = htmlspecialchars($data["nim"]);
      $email = htmlspecialchars($data["email"]);
      $jurusan = htmlspecialchars($data["jurusan"]);
    
      // upload gambar
        $gambar = upload();
        // tanda seru ! adalah not atau false
        if(!$gambar){
        return false;
        }

    
 
    $query = "INSERT INTO mahasiswa
                VALUES
        ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


function upload(){
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada yang di upload
    if( $error === 4 ){
        echo"<script>
        alert('pilih gambar terlebih dahulu');
        </script>";

        return false;
    }

    // cek apakah yang di upload gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    // memecah string menjadi array 
    $ekstensiGambar = explode('.', $namaFile);
    // fungsi strtolower untuk menjadikan semua hruf kecil & end mengambil nama paling belakang/akhir
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo"<script>
            alert('yang anda upload bukan gambar!');
            </script>";
    
            return false;
    }
    // cek jika ukurannya terlalu besar
    if ( $ukuranFile > 1000000) {   // 1MB mungkin terserah admin mau berapa besar ukuran gambarnya
        echo"<script>
        alert('ukuran gambar terlalu besar');
        </script>";

        return false;
    }
        // 
        // generete nama gambar baru atau mungkin menurut saya mungkin nanti gambarnya tidak ketimpah oleh gabar yang namanya sama walaupun berbeda foto dan jika nama sama dan foto berbeda nanti di db nya ngaru mungkin itu menurut saya
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        
        // lolos pengecekan, gambar siap di upload  & Mungkin juga menurut saya gambar yang berbeda temmpat akan masuk ke folder img karena saya menamakan foldernya img 
        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function ubah($data) {

    global $conn;
    // htmlspecialchars     adalah untuk mengetahui coding yang akan hack web kalian atau saya dll intinya untuk mengamankan web tersebut
      $id = $data["id"];
      $nama = htmlspecialchars($data["nama"]);
      $nim = htmlspecialchars($data["nim"]);
      $email = htmlspecialchars($data["email"]);
      $jurusan = htmlspecialchars($data["jurusan"]);
      $gambarLama = htmlspecialchars($data["gambarLama"]);

      // cek apakah user pilih gambar baru atau tidak
      if( $_FILES['gambar']['error'] === 4 ) {
          $gambar = $gambarLama;
      } else {
        $gambar = upload();
      }
      
 
    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                nim = '$nim',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambar'
                WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keyword%' OR
            nim  LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' 
            ";
    // terserah kalau pakai LIKE atau =  karena nanti tampilnya berbeda beda kalau LIKE ada penambahan %   
            
    return query($query);
    // function yang sudah di buat contoh $query memmanggil function yang baru query  mungkin
}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]) );
    $password =  mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username sudah ada atau belum
    $result =  mysqli_query($conn, "SELECT username FROM user WHERE 
            username = '$username'");

    if ( mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('username sudah terdaftar')
              </script>";

              return false;
    }


    // cek konfirmasi password
    if( $password != $password2 ) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
            </script>
        ";

        return false;
      }

    //  enkripsi password    
    $password = password_hash($password, PASSWORD_DEFAULT); // password default adalah algortima
    
   // tambahan userbaru ke database
   mysqli_query($conn, "INSERT INTO user VALUES('', '$username','$password')");

   return mysqli_affected_rows($conn);

}
?>