<?php
session_start();
require_once("../_config/config.php");
require_once("../_config/database.php");
include "../_config/m_process.php";

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
  <title>BKK - Login</title>
  <!-- Icon -->
  <link rel="icon" type="image/png" href="img/logo-fadilah.png" sizes="16x16">
  <!-- Custom fonts for this template-->
  <link href="../_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../_assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">  
    .cari{
      border-left: 0.5px solid silver;
      border-right: 0.5px solid silver;
      border-bottom: 0.5px solid silver;
      border-bottom-left-radius: 5px;
      border-bottom-right-radius: 5px;
      box-shadow: 2px 2px 1px #6c757d;    
      display: line-block;
      width: 350px;
      cursor: pointer;
      list-style: none;
      margin: 5px;
      padding: 5px;
      background-color: white;
      position: absolute;
      z-index:99;
    }
    .cari li:hover{
      background-color: blue;
      color: white;
    }
    .hasil tr td{
      padding: 15px;
    }
  </style>
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div id="tampil_data" class="col-lg-6 d-flex justify-content-center align-items-center">
                <a href="../index.php">
                  <img src="../img/logo-fadilah.png">
                </a>   
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                  </div>
                  <form action="" method="POST" class="user">
                    <div class="form-group">
                      <?php
                        if (@$_GET['as'] == '' || @$_GET['as'] == 'guru') {
                          ?>
                          <input type="text" class="form-control form-control-user" id="nik" name="nik" aria-describedby="textHelp" placeholder="Masukan Nomor Induk Guru...">
                          <?php
                        } elseif (@$_GET['as'] == 'siswa') {
                          ?>
                          <input type="text" class="form-control form-control-user" id="nis" name="nis" aria-describedby="textHelp" placeholder="Masukan Nomor Induk Siswa...">
                          <?php
                        } elseif (@$_GET['as'] == 'lupa') {
                          ?>
                          <div class="form-group">
                            <label for="jur">Pilih Jurusan</label>
                            <select class="form-control" id="jur" name="jur">
                              <option selected disabled>Pilih...</option>
                              <option value="RPL">RPL</option>
                              <option value="TKJ">TKJ</option>
                              <option value="MM">MM</option>
                              <option value="APH">APH</option>
                              <option value="TKR">TKR</option>
                              <option value="TSM">TSM</option>
                            </select>
                          </div>
                          <hr>
                          <div class="form-group">
                            <label for="nama">Tuliskan Nama</label>
                            <input type="text" class="form-control form-control-user" name="nama" id="nama" autocomplete="off">
                            <div id="txtnama" class="hasil"></div>
                          </div>                         
                          <?php
                        }
                      ?>                      
                    </div>
                    <?php
                      if (@$_GET['as'] != 'lupa') {
                        ?>
                        <input class="btn btn-primary btn-user btn-block" type="submit" name="login" value="Login">
                        <?php
                      } else {
                        ?>
                        <button id="cari_alumni" class="btn btn-success btn-user btn-block"><i class="fa fa-magnifier"></i> Tampilkan</button>
                        <?php
                      }
                    ?>
                                                           
                  </form>
                  <hr>
                  <?php
                    if (@$_GET['as'] == '' || @$_GET['as'] == 'guru') {
                      ?>
                      <a href="?as=siswa" class="btn btn-success btn-user btn-block">
                        Login sebagai Alumni
                      </a>
                      <?php
                    } elseif (@$_GET['as'] == 'siswa') {
                      ?>
                        <a href="?as=guru" class="btn btn-success btn-user btn-block">
                          Login sebagai Guru
                        </a>
                        <div class="col-md-6">
                          <a href="?as=lupa">Lupa Nomor Induk?</a>
                        </div>                        
                      <?php
                    }
                  ?>        
                </div>
              </div>
              <?php
                $nik = $connection->conn->real_escape_string(@$_POST['nik']);
                $nis = $connection->conn->real_escape_string(@$_POST['nis']);

                if (@$_POST['login']) {
                  if (@$_GET['as'] == 'guru' || @$_GET['as'] == '') {
                    $cek = $proses->loginguru($nik);
                    $row = $cek->num_rows;
                    if ($row > 0) {
                      while ($data = $cek->fetch_object()) {
                        @$_SESSION['guru'] = $data->ID_USER;
                        header('location: ../index.php');
                      }
                    } else {
                      echo "<script>alert('NIK tidak ditemukan.')</script>";
                    }
                  } elseif (@$_GET['as'] == 'siswa') {
                    $cek = $proses->loginsiswa($nis);
                    $row = $cek->num_rows;
                    if ($row > 0) {
                      while ($data = $cek->fetch_object()) {
                        @$_SESSION['siswa'] = $data->NO;
                        header('location: ../index.php');
                      }
                    } else {
                      echo "<script>alert('NIS tidak ditemukan.')</script>";
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../_assets/vendor/jquery/jquery.min.js"></script>
  <script src="../_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../_assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../_assets/js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    function fillnama(txtnama){
      $("#nama").val(txtnama);
      $('#txtnama').hide();
    }
    $(document).ready(function(){
      $('#nama').keyup(function(){
        if ($('#jur').val() === null) {
          alert("Silahkan pilih jurusan!");
          $(this).val("");
        } else {
          var jur = $('#jur').val();
          var nama = $('#nama').val();
          if (nama == "") {
            $('#txtnama').html("");
          } else {
            $.ajax({
              type: "POST",
              url: "cari.php",
              data: {
                jur: jur,
                nama: nama
              },
              success: function(html){
                $("#txtnama").html(html).show();
              }
            });
          }
        }    
      });
      $(document).on("click", "#cari_alumni", function(e){
        var jurusan = $('#jur').val();
        var nama_lengkap = $('#nama').val();
        e.preventDefault();
        if (jurusan == null) {
          alert("Harap pilih jurusan!");
        } else if (nama_lengkap == "") {
          alert("Harap tuliskan nama lengkap!")
        } else {
          $.ajax({
            type: "POST",
            url: "lihat_data.php",
            data: {
              jurusan: jurusan,
              nama: nama_lengkap
            },
            success: function(msg){
              $("#tampil_data").html(msg).show();
            }
          });
        }
      });
    })
  </script>

</body>

</html>
