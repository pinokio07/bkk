<?php
class Database {
	private $servername;
	private $username;
	private $password;
	private $dbname;
	public $conn;

	function __construct ($servername, $username, $password, $dbname){
		$this->host = $servername;
		$this->user = $username;
		$this->pass = $password;
		$this->database = $dbname;

		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database) or die (
			mysqli_error());
		if (!$this->conn){
			return false;
		} else {
			return true;
		}
	}
}
?>