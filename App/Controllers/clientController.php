<?php 
include '../Models/Reservation.php';
include '../database.php';

$controller = new ClientController();

class ClientController {
	

	function __construct(){
		if (isset($_POST['postClientName'])){
			$this->checkIfUserHaveRegistrations();
		}
	}
	
	public function checkIfUserHaveRegistrations(){
		$database = new MySqlObject();
		$reservation = new Reservation($_POST['name'],$_POST['surname']);
		$nameAndSurname = "". $_POST['name'] . " ".$_POST['surname'];
		$query = "SELECT Count(id) from reservations where clientNameAndSurname = "."'$nameAndSurname'";
		$result = $database->select($query);
		var_dump($result);
	}
}

?>