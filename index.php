<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari ditekan
if (isset($_POST["cari"]) ){
    $mahasiswa = cari ($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Admin</title>
  
  <style>
        .loader {
        width: 50px;
        /* position: absolute; */
        top: 140px;
        left: 400px;
        z-index: -1;
        display: none;
    }
/* untuk menghilangkan tampilan ketika akan di print/pdf*/
    @media print{
        .logout, .tambah, .form-cari, .aksi {
        display: none;
    }
}
    </style>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/script.js"></script>    

  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.php"><img src="assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg"
            alt="logo" /></a>
      </div>
      <ul class="nav">

        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="index.php">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg"
              alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form action="" method="post" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search form-cari">
                <input type="text" name="keyword" size="50" autofocus class="form-control text-light" placeholder="Masukkan keywords pencarian..." autocomplete="off" id="keyword">
                   <div class="input-group-append">
                     <button class="btn btn-md btn-primary" type="submit" name="cari" id="tombol-cari">Cari</button>
                   </div>
                   <img src="img/loader.gif" class="loader">
              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                <div class="navbar-profile">

                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>

                <a href="logout.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>

              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="mb-3" id="button">
            <a href="tambah.php" class="text-decoration-none btn btn-primary">
              <i class="mdi mdi-account-plus btn-icon-prepend"></i> Tambah Data Mahasiswa </a>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Daftar Mahasiswa</h4>
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
              </div>
            </div>
          </div>
          <a href="cetak.php" target="_blank" class="text-decoration-none btn btn-primary">
            <i class="mdi mdi-printer btn-icon-prepend"></i> Cetak </a>
        </div>


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Created with by Deny Maulana</span>

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>