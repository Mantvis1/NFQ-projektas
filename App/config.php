<?php	
	$conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	if ($conn->connect_error) {
		die("connection failed: " . $conn->connect_error);
	}
?>
