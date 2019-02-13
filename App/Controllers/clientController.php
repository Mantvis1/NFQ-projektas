<?php 
include '../Models/Reservation.php';

$controller = new ClientController();


class ClientController {
	
	function __construct(){
		if (isset($_POST['postClientName'])){
			$this->checkIfUserHaveRegistrations();
		}
	}
	
	public function checkIfUserHaveRegistrations(){
		$reservation = new Reservation($_POST['name'],$_POST['surname']);
		var_dump($reservation);
	}
}

?>