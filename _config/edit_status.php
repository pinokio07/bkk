<?php
require_once("config.php");
require_once("database.php");
include "m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);

$id = @$_POST['id'];
$dtl = @$_POST['dtl'];
$status = @$_POST['status'];
$detail = @$_POST['detail'];
$telepon = @$_POST['telepon'];

$proses->cari("UPDATE tb_alumni SET STATUS = '$status', DETAIL = '$dtl', TELP = '$telepon' WHERE NO = '$id' ");

echo "<script>window.location='?page=alumni'</script>";
?>