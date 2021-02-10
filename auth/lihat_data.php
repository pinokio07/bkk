<?php
require_once("../_config/config.php");
require_once("../_config/database.php");
include "../_config/m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);

$jurusan = @$_POST['jurusan'];
$nama = @$_POST['nama'];

$hasil = $proses->cari("SELECT * FROM tb_alumni WHERE NAMA = '$nama' AND STUDI = '$jurusan' ");

while ($data = $hasil->fetch_object()) {
	?>
	<div class="text-center">
	  <h1 class="h4 text-gray-900 mb-4">Data siswa : <?php echo $data->NAMA; ?></h1>
	  <p>NIS : <?php echo $data->NIS; ?></p>
	  <a href="?as=siswa" class="btn btn-primary btn-user btn-block"> Lanjut ke halaman Login</a>
	</div>
	<?php
}
?>   