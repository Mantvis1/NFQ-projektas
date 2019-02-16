<?php
session_start();
include '../database.php';
include '../Models/visitsModel.php';
include '../Models/reservationListModel.php';

$controller = new haircutterController();

class haircutterController{

  function __construct(){
    if(isset($_POST['userSearch'])){
      $this->foundCostumersInfo();
    }else if(isset($_POST['postHaircutterName'])){
      $this->loadHairCutterMeniu();
    }else if(isset($_POST['findInfoAboutOneCustomer'])){
      $this->getInfoAboutCustomers();
    }else if(isset($_POST['firstPartOfReservation'])){
      $this->firstPartOfReservation();
    }else if(isset($_POST['secondPartOfReservation'])){
      $this->secondPartOfReservation();
    }else if(isset($_POST['thirdPartOfReservation'])){
      $this->thirdPartOfReservation();
    }else if(isset($_POST['filter'])){
      $this->Filter();
    }
  }

  function foundCostumersInfo(){
    $database = new MySqlObject();
    $costumerInfo = $database->findCostumersVisitsCountByName($_POST['name']);
    while ($row = $costumerInfo->fetch_assoc()) {
      $visits = new VisitsModel($_POST['name'], $row['visitsCount']);
    }
    $costumerInfo = $database->checkIfUserWasRegistred($visits->uName);
    while ($row = $costumerInfo->fetch_assoc()) {
     $visitsCount = $row["Count(id)"];
    }
    $message = '';
    if($visits->visitsCount > 0){
    if($visitsCount == 1 && ($visits->visitsCount % 5) == 0){
      $message = "Vartotojas yra uzsiregistraves. Jis gaus nuolaidą kai atvyks.";
    }
    else if($visitsCount == 1 && (($visits->visitsCount % 5) != 0)){
       $message ="Vartotojas yra uzsiregistraves, taciau negaus nuolaidos.";
    }
    else if($visitsCount == 0 && (($visits->visitsCount+1) % 5) == 0){
      $message = "Vartotojas nera uzsiregistraves. Jis gaus nuolaidą, kai uzsiregistruos ir atvyks.";
    }
    else if($visitsCount == 0 && (($visits->visitsCount+1) % 5) != 0){
      $message = "Vartotojas nera uzsiregistraves. Jis taip pat negaus nuolaidos, kai uzsiregistruos ir atvyks.";
    }
 }else {
    $message = "Vartotojas dar nei karto neapsilanke";
  }
  $_SESSION['message'] = $message;
   header("Location: ../Views/Haircutter/customerSearch.php");
  }

  function loadHairCutterMeniu(){
    $database = new MySqlObject();
    $nameAndSurname = $_POST['name']." ".$_POST['surname'];
    $queryResult = $database->IfHaircutterExists($nameAndSurname);
    while($row = $queryResult->fetch_assoc()){
      if($row["Count(id)"] == 1){
        $_SESSION['haircutterName'] = $nameAndSurname;
      }
    }
    if(isset($_SESSION['haircutterName'])){
      header("Location: ../Views/Haircutter/meniu.php");
    }else{
      $message = "Nera tokio kirpejo";
      header("Location: ../Views/Haircutter/main.php?message=".$message);
    }

  }

  function getInfoAboutCustomers(){
    $database = new MySqlObject();
    $queryResult = $database->checkIfUserWasRegistred($_POST['customerName']);
    var_dump($_POST['customerName']);
    while($row = $queryResult->fetch_assoc()){
      $userRegistrationCount = $row["Count(id)"];
      var_dump($row);
    }
    if($userRegistrationCount == 0){
      $message = "registraciju nera";
    }else {
      $queryResult = $database->cancelRegistration($_POST['customerName']);
      $message = "registracija sekmingai atsaukta";
    }
    
    header("Location: ../Views/Haircutter/cancel.php?message=".$message);

  }

  function firstPartOfReservation()
  {
    var_dump($_POST);
    var_dump($_SESSION);
    $dates = array();
		 for($index = 0; $index < 7;$index++){
			 $dates[$index] = date("Y-m-d", strtotime("+".$index." day"));
		 }
     $_SESSION['dates'] = $dates;
     $_SESSION['name'] = "". $_POST['name'] . " ".$_POST['surname'];
		 header("Location: ../Views/Haircutter/reservation2.php");
  }  

  function secondPartOfReservation(){
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
    $_SESSION['dates'] = NULL;
    $_SESSION['selectedDay'] = $_POST['daySelect'];
    var_dump($_SESSION);
    header("Location: ../Views/Haircutter/reservation3.php");
  
  }

  function thirdPartOfReservation(){
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
    $_SESSION['message'] = "Registracija sekminga";
  header("Location: ../Views/Haircutter/meniu.php");
  }

  function Filter(){
    $database = new MySqlObject();
    $queryResult = $database->GetHaircutterIdByName($_SESSION['haircutterName']);
    while ($row = $queryResult->fetch_assoc()) {
      $indexOfHaircutter = $row["id"];
    }


  $queryResult = $database->GetAllReservations($indexOfHaircutter);
    $reservations = array();
    $index = 0;
    while ($row = $queryResult->fetch_assoc()) {
       $reservations[$index++] = $row;
      }

      $_SESSION['reservations'] = $reservations;
   //   var_dump($_SESSION['reservations']);
      header("Location: ../Views/Haircutter/loyalCostumers.php");
  }
}