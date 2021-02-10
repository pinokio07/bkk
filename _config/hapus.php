<?php
require_once("config.php");
require_once("database.php");
include "m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);

$id = @$_POST['id'];

$proses->cari("UPDATE tb_lowongan SET STATUS = 'Dihapus' WHERE ID_JOB = '$id' ");

echo "<script>window.location='?page=lowongan'</script>";
?>