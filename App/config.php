<?php	
class Configuration{
		public $conn = '';
		function __construct(){
		$conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
		if ($conn->connect_error) {
			die("connection failed: " . $conn->connect_error);
		}
	}
}
?>