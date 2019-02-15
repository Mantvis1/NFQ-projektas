<?php 
include '../Models/Reservation.php';
include '../database.php';
session_start();
$controller = new ClientController();

class ClientController {
	function __construct(){
		if (isset($_POST['postClientName'])){
			$this->checkIfUserHaveRegistration();
		}else if(isset($_POST['cancel'])){
			$this->cancelRegistration();
		}else if(isset($_POST['firstPartOfReservation'])){
      $this->FirstPartOfReservation();
    }else if(isset($_POST['secondPartOfReservation'])){
			$this->SecondPartOfReservation();
		}
	}
	
	public function checkIfUserHaveRegistration(){
		$database = new MySqlObject();
		$reservation = new Reservation($_POST['name'],$_POST['surname']);
		$nameAndSurname = "". $reservation->uName . " ".$reservation->uSurname;
		$_SESSION['name'] = $nameAndSurname;
		$queryResult = $database->checkIfUserWasRegistred($nameAndSurname);
		 while ($row = $queryResult->fetch_assoc()) {
			 if($row["Count(id)"] == 0){
				header("Location: ../Views/Client/reservation.php");
			 }else {
				 $queryResult = $database->checkUserRegistrationInfo($nameAndSurname);
				 while ($row = $queryResult->fetch_assoc()) {
					$_SESSION['clientReservationInformation'] = $row;
					header("Location: ../Views/Client/cancel.php");
				 }
			 }
		}
	}

	public function cancelRegistration(){
		$database = new MySqlObject();
		$queryResult = $database->cancelRegistration($_SESSION['name']);
		if($queryResult == true){
			header("Location: ../Views/Client/reservation.php");
		}
	}

	function FirstPartOfReservation(){
		header("Location: ../Views/Client/reservation2.php?haircutter=".$_POST['haircutterSelect']);
    //var_dump($_POST);
	}
	
	function SecondPartOfReservation(){
		var_dump($_POST);
	}

}

?>