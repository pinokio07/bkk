<?php
session_start();

require_once("_config/config.php");
require_once("_config/database.php");
include "_config/m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>BKK - SMK FADILAH</title>
  <!-- Icon -->
  <link rel="icon" type="image/png" href="img/logo-fadilah.png" sizes="16x16">
  <!-- Custom fonts for this template-->
  <link href="_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="_assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for Table -->
  <link href="_assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=main">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BKK</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="?page=main">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Data Siswa
      </div>
      <!-- Siswa -->
      <li class="nav-item">
        <a class="nav-link" href="?page=alumni">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Alumni</span></a>
      </li>
      <!-- Divider -->      
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Lowongan
      </div>
      <!-- Siswa -->
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-briefcase"></i>
          <span>Lowongan</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          
                
              
          <div class="bg-white py-2 collapse-inner rounded">
            <?php
              if (@$_SESSION['guru']) {
              ?>
            <h6 class="collapse-header">Edit:</h6>
            <a class="collapse-item" href="?page=tambah"><i class="fas fa-fw fa-plus"></i> Tambah Lowongan</a> 
            <div class="collapse-divider"></div>
              <?php
              }
            ?>
            <h6 class="collapse-header">Jurusan:</h6>
            <a class="collapse-item" href="?page=lowongan&jur=TIK"><i class="fas fa-fw fa-laptop-code"></i> TIK</a>
            <a class="collapse-item" href="?page=lowongan&jur=APH"><i class="fas fa-fw fa-hotel"></i> APH</a>
            <a class="collapse-item" href="?page=lowongan&jur=TKR"><i class="fas fa-fw fa-car"></i> TKR</a>
            <a class="collapse-item" href="?page=lowongan&jur=TBSM"><i class="fas fa-fw fa-motorcycle"></i> TBSM</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">            
            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <?php
              if (@$_SESSION['guru']) {
                ?>
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php
                          $user = $proses->user(@$_SESSION['guru']);
                          while ($nama = $user->fetch_object()) {
                          ?>
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                          <?php                          
                            echo $nama->NAMA_LENGKAP;
                            ?>

                      </span>
                      <img class="img-profile rounded-circle" src="img/user/guru/<?php echo $nama->FOTO; ?>">
                          <?php
                          }
                      ?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="?page=profil">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                      </a>               
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                    </div>
                  </li>
                <?php
              } elseif (@$_SESSION['siswa']) {
                ?>
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php
                          $user = $proses->alumni(@$_SESSION['siswa']);
                          while ($nama = $user->fetch_object()) {
                          ?>
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                          <?php                          
                            echo "Welcome, ".$nama->NAMA;
                            ?>

                      </span>                      
                          <?php
                          }
                      ?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                    </div>
                  </li>
                <?php
              } else {
                ?>
                  <a class="btn btn-primary" href="auth/login.php"><i class="fas fa-login"></i> Login</a>
                <?php
              }
            ?>
            
          </ul>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
            if (@$_GET['page'] == "" || @$_GET['page'] == "main") {
              include "pages/main.php";
            } elseif (@$_GET['page'] == "alumni") {
              include "pages/alumni.php";
            } elseif (@$_GET['page'] == "lowongan") {
              include "pages/lowongan.php";
            } elseif (@$_GET['page'] == "tambah") {
              if (@$_SESSION['guru']) {
                include "pages/tambah.php";
              } else {
                include "pages/main.php";
              }             
            } elseif (@$_GET['page'] == "edit") {
              include "pages/edit.php";
            } elseif (@$_GET['page'] == "profil") {
              include "pages/profil.php";
            }
          ?>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SMK Fadilah 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="auth/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="_assets/vendor/jquery/jquery.min.js"></script>
  <script src="_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="_assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="_assets/js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="_assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="_assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#dataGuru').DataTable({
        responsive: true
      });
      $('#dataAlumni').DataTable({
        responsive: true,
        scrollX: true,
        ordering: false                     
      });      
    });
  </script>

</body>

</html>