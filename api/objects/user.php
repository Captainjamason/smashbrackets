<?php
class User {
	private $conn;
	private $table_name = "accounts";

	public $uname;
	public $pass;
	public $money;

	public function __construct($db) {
		$this->conn = $db;
	}

	function create() {
		$query = "INSERT INTO " . $this->table_name . " SET uname = :uname, pass = :pass, money = :money";
		$stmt = $this->conn->prepare($query);

		$this->uname=htmlspecialchars(strip_tags($this->uname));
		$this->pass=htmlspecialchars(strip_tags($this->pass));
		$this->money=htmlspecialchars(strip_tags($this->money));

		$stmt->bindParam(':uname', $this->uname);
		$password_hash = password_hash($this->pass, PASSWORD_DEFAULT);
		$stmt->bindParam(':password', $password_hash);
		$stmt->bindParam(':money', $this->money);

		if($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
?>
