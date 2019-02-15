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
		}else if(isset($_POST['thirdPartOfReservation'])){
			$this->ThirdPartOfReservation();
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
				 $hairCutterList = $database->GetAllHaircutters();
				$haircutters = array();
				$index = 0;
				 while ($row = $hairCutterList->fetch_assoc()) {
						$haircutters[$index++] = $row;
				 }
				 $_SESSION['haircutterList'] = $haircutters;
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
		$dates = array();
		 for($index = 0; $index < 7;$index++){
			 $dates[$index] = date("Y-m-d", strtotime("+".$index." day"));
		 }
		 $_SESSION['dates'] = $dates;
		 header("Location: ../Views/Client/reservation2.php?haircutter=".$_POST['haircutterSelect']);
}

function SecondPartOfReservation(){
	$database = new MySqlObject();
	$queryResult = $database->GetHaircutterIdByName($_POST['haircutterName']);
	 while ($row = $queryResult->fetch_assoc()) {
		$haircutterId = $row;
	 }
	$startTime = date("10:00");
	$times = array();
	$index = 0;
	while($startTime <= date("19:45")){
		$queryResult = $database->CheckIfTimeIsFree($_POST['daySelect'],$startTime,$haircutterId["id"]);
		$currentResult = '';
		while ($row = $queryResult->fetch_assoc()) {
			$currentResult = $row["COUNT(id)"];
		 }
		if($currentResult == 0){
			$times[$index++]= $startTime;
		}
		$startTime = strtotime($startTime);
		var_dump($startTime);
	}
	
//	header("Location: ../Views/Client/reservation3.php?haircutter=".$_POST['haircutterName']."&day=".$_POST['daySelect']);
}

function ThirdPartOfReservation(){
	var_dump($_POST);
}

}

?>