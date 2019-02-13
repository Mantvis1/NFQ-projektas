<?php 
include '../Models/Reservation.php';
include '../database.php';
session_start();
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
		$nameAndSurname = "". $reservation->uName . " ".$reservation->uSurname;
		$_SESSION['name'] = $nameAndSurname;
		$result = $database->checkIfUserWasRegistred($nameAndSurname);
		 while ($row = $result->fetch_assoc()) {
			 if($row["Count(id)"] == 0){
				header("Location: ../Views/Client/reservation.php");
			 }else {
				 $result = $database->checkUserRegistrationInfo($nameAndSurname);
				 while ($row = $result->fetch_assoc()) {
					$_SESSION['clientReservationInformation'] = $row;
					header("Location: ../Views/Client/cancel.php");
				 }
			 }
		}
	}
}

?>