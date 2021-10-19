<?php
	class DbConnect{
		private $host = "localhost";
		private $dbname = "test_cart";
		private $username = "root";
		private $password = "";

		public $connection;

		public function __construct(){
			try{
				$this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
			}catch(PDOException $ex){
				echo $ex->getMessage();

			}
		}
	}
?>