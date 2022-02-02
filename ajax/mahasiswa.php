<?php
// sleep/usleep untuk contoh saja 
usleep(500000);
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
            WHERE
        nama LIKE '%$keyword%' OR
        nim  LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%' 
         ";
$mahasiswa = query($query);

?>


                <div class="table-responsive" id="container">
                  <table class="table table-dark">
                    <thead>
                      <tr>
                        <th> No </th>
                        <th class="aksi"> Aksi </th>
                        <th> Gambar </th>
                        <th> NIM </th>
                        <th> Nama </th>
                        <th> Email </th>
                        <th> Jurusan </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 1; ?>
                    <?php foreach ($mahasiswa as $row ) : ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td class="aksi"> <a href="ubah.php?id=<?= $row["id"]; ?>" class="text-decoration-none btn btn-outline-primary"> Ubah <i
                              class="mdi mdi-file-check btn-icon-append"></i>
                          </a> | <a href="hapus.php?id=<?= $row["id"]; ?>" onclick=" return confirm('yakin');" class="text-decoration-none btn btn-outline-primary"> Hapus <i
                              class="mdi mdi-delete btn-icon-append"></i>
                          </a> </td>
                        <td> 
                        <img src="img/<?php echo $row["gambar"];  ?>">
                        </td>
                        <td><?= $row["nim"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                        <td><?= $row["jurusan"]; ?></td>
                      </tr>
                      <?php $i++; ?>
                      <?php endforeach;  ?>

                    </tbody>
                  </table>
                </div>