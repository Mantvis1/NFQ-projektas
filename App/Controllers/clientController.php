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
		var_dump($database);
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
		$database->UpdateUserVisitsTableAfterCancel($_SESSION['name']);
		if($queryResult == true){
			header("Location: ../Views/Client/main.php");
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
	$startTime = "10:00";
	$times = array();
	$hours = 10;
	$minutes = 0;
	$index = 0;
	while($startTime != date("19:45")){
	
		$queryResult = $database->CheckIfTimeIsFree($_POST['daySelect'],$startTime,$haircutterId["id"]);
		
		$currentResult = '';
		while ($row = $queryResult->fetch_assoc()) {
			$currentResult = $row["COUNT(ID)"];
		 }
		if($currentResult == 0){
			$times[$index++]= $startTime;
		}
		if($minutes + 15 == 60){
			$hours += 1;
			$minutes -= 45;
			
		}else{
			$minutes += 15;
		}
		$startTime = "".(string)$hours.":".(string)$minutes."";
		if(strlen($startTime) == 4){
			$startTime = $startTime."0";
		}
		
	}
	$_SESSION['times'] = $times;
	header("Location: ../Views/Client/reservation3.php?haircutter=".$_POST['haircutterName']."&day=".$_POST['daySelect']);
}

function ThirdPartOfReservation(){
//	var_dump($_POST);
	$database = new MySqlObject();
	$test = $database->GetHaircutterIdByName($_POST['haircutterName']);
	while ($row = $test->fetch_assoc()) {
		$haircutterId = $row;
	 }
	$database->insertNewReservation($_POST['clientName'], $_POST['day'], $_POST['timeSelect'], $haircutterId["id"]);
	
	$test = $database->CheckIfUserExsitsInVisitsTable($_POST['clientName']);
	while ($row = $test->fetch_assoc()) {
		$countVisitsOfSpeciefiedUser = $row['COUNT(id)'];
	 }
	if($countVisitsOfSpeciefiedUser == 0){
		$database->CreateNewUserVisitsCountTable($_POST['clientName']);
	}else {
		$database->UpdateUserVisitsTable($_POST['clientName']);
	}
	
	
	$queryResult = $database->checkUserRegistrationInfo($_POST['clientName']);
	while ($row = $queryResult->fetch_assoc()) {
		$_SESSION['clientReservationInformation'] = $row;
		}
	header("Location: ../Views/Client/cancel.php");
	}
}

?>