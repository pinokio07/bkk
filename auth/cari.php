<?php
require_once("../_config/config.php");
require_once("../_config/database.php");
include "../_config/m_process.php";

$connection = new Database ($servername, $username, $password, $dbname);
$proses = new Process($connection);

if (isset($_POST['nama'])) {
	$jur = @$_POST['jur'];
	$nam = @$_POST['nama'];

	$sql = "SELECT * FROM tb_alumni WHERE STUDI = '$jur' AND NAMA LIKE '%$nam%' LIMIT 5 ";

	$hsl = $proses->cari($sql);

	echo "<ul class='cari'>";
	while ($data = $hsl->fetch_object()) {
		?>
		<li onclick="fillnama('<?php echo $data->NAMA; ?>')">
			<a>
				<?php echo $data->NAMA; ?>
			</li></a>		
		<?php
	}
}
?>