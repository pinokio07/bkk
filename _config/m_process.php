<?php
class Process
{
	Private $mysqli;

	function __construct($conn)
	{
		$this->mysqli = $conn;
	}

	Public function loginguru ($nik)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_user WHERE NIK = '$nik'";
		
		$query = $db->query($sql) or die ($db->error);

		return $query;
	}

	Public function loginsiswa ($nis)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_alumni WHERE NIS = '$nis'";
		
		$query = $db->query($sql) or die ($db->error);

		return $query;
	}

	Public function user ($id)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_user WHERE ID_USER = '$id'";
		
		$query = $db->query($sql) or die ($db->error);

		return $query;
	}

	Public function alumni ($id = null)
	{
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_alumni";
		if ($id != null){
			$sql .= " WHERE NO = $id";
		}
		$query = $db->query($sql) or die ($db->error);

		return $query;
	}

	Public function tambah ($nama, $pt, $studi, $gaji, $email, $mulai, $akhir, $skill, $detail){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO tb_lowongan VALUES ('', '$nama', '$pt', '$studi', '$gaji', '$email', '$mulai' , '$akhir' , '$skill' , '$detail', '' )") or die ($db->error);
	}

	Public function cari($sql)
	{
		$db = $this->mysqli->conn;		
		$query = $db->query($sql) or die ($db->error);
		
		return $query;
	}

	function __destruct(){
		$db = $this->mysqli->conn;
		$db->close();
	}

}
?>