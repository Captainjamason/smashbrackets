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
}
?>
