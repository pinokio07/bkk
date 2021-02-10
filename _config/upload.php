<?php
session_start();
require_once("config.php");
require_once("database.php");
include "m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);
$gambar = @$_POST['gambar'];

if (@$_SESSION['guru']) {
	$extensi = explode(".", $_FILES['$gambar']['name']);
  $user_pic = "brg-".round(microtime(true)).".".end($extensi);
  $sumber = $_FILES['gambar']['tmp_name'];
  $upload = move_uploaded_file($sumber, "img/user/guru/".$user_pic);
  if ($upload) {
  	$ganti = $proses->cari("UPDATE tb_user SET FOTO = '$gambar'");
	header("location: ../index.php?page=profil");
  } else {
  	echo "<script>alert('Upload gambar Gagal.')</script>";
  }
	
}

?>