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
    }else if(isset($_POST['filterByDate'])){
      $this->FilterByDate();
    }else if(isset($_POST['filterByName'])){
      $this->FilterByName();
    }else if(isset($_POST['removeFilter'])){
      $this->removeFilter();
    }
  }

  function foundCostumersInfo(){
    $database = new MySqlObject();
    $costumerInfo = $database->findCostumersVisitsCountByName($_POST['name']);
    $visits = 0;
    while ($row = $costumerInfo->fetch_assoc()) {
      $visits = $row['visitsCount'];
    }
    $costumerInfo = $database->checkIfUserWasRegistred($_POST['name']);
    while ($row = $costumerInfo->fetch_assoc()) {
     $visitsCount = $row["Count(id)"];
    }
    $message = '';
    if($visits  > 0){
    if($visitsCount == 1 && ($visits % 5) == 0){
      $message = "Vartotojas yra uzsiregistraves. Jis gaus nuolaidą kai atvyks.";
    }
    else if($visitsCount == 1 && (($visits % 5) != 0)){
       $message ="Vartotojas yra uzsiregistraves, taciau negaus nuolaidos.";
    }
    else if($visitsCount == 0 && (($visits+1) % 5) == 0){
      $message = "Vartotojas nera uzsiregistraves. Jis gaus nuolaidą, kai uzsiregistruos ir atvyks.";
    }
    else if($visitsCount == 0 && (($visits+1) % 5) != 0){
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
    $this->SetDates();
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
    while($row = $queryResult->fetch_assoc()){
      $userRegistrationCount = $row["Count(id)"];
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
    $this->SetDates();
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
    $_SESSION['selectedDay'] = $_POST['daySelect'];
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

  function FilterByDate(){
    $database = new MySqlObject();
    $queryResult = $database->GetHaircutterIdByName($_SESSION['haircutterName']);
    while ($row = $queryResult->fetch_assoc()) {
      $indexOfHaircutter = $row["id"];
    }
  $time = date("Y-m-d", strtotime("0 day"));
  $queryResult = $database->GetAllReservations($indexOfHaircutter, $time);
    $reservations = array();
    $index = 0;
    while ($row = $queryResult->fetch_assoc()) {
       $reservations[$index++] = $row;
      }
      $index = 0;
      foreach($reservations as $reservation){
        if($reservation["startDay"] != $_POST['daySelect']){
          unset($reservations[$index]);
        }
        $index++;
      }
      $_SESSION['reservations'] = $reservations;
      $this->SortByVisitsTime();
      header("Location: ../Views/Haircutter/loyalCostumers.php");
  }

  function FilterByName(){
    $database = new MySqlObject();
    $queryResult = $database->GetHaircutterIdByName($_SESSION['haircutterName']);
    while ($row = $queryResult->fetch_assoc()) {
      $indexOfHaircutter = $row["id"];
    }
    $time = date("Y-m-d", strtotime("0 day"));
    $queryResult = $database->GetAllReservations($indexOfHaircutter, $time);
    $reservations = array();
    $index = 0;
    while ($row = $queryResult->fetch_assoc()) {
       $reservations[$index++] = $row;
      }
      $_SESSION['reservations'] = $reservations;
      $index = 0;
      foreach($reservations as $reservation){
        if($reservation["clientNameAndSurname"] != $_POST['clientName']){
          unset($reservations[$index]);
        }
        $index++;
      }
     $_SESSION['reservations'] = $reservations;
     $this->SortByVisitsTime();
      header("Location: ../Views/Haircutter/loyalCostumers.php");
  }

  function removeFilter(){
    $database = new MySqlObject();
    $queryResult = $database->GetHaircutterIdByName($_SESSION['haircutterName']);
    while ($row = $queryResult->fetch_assoc()) {
      $indexOfHaircutter = $row["id"];
    }
    $time = date("Y-m-d", strtotime("0 day"));
    $queryResult = $database->GetAllReservations($indexOfHaircutter, $time);
    $reservations = array();
    $index = 0;
    while ($row = $queryResult->fetch_assoc()) {
       $reservations[$index++] = $row;
      }

      $_SESSION['reservations'] = $reservations;
      $this->SortByVisitsTime();
      header("Location: ../Views/Haircutter/loyalCostumers.php");
  }

  function SetDates(){
    $dates = array();
    for($index = 0; $index < 7;$index++){
      $dates[$index] = date("Y-m-d", strtotime("+".$index." day"));
    }
    $_SESSION['dates'] = $dates;
    
  }

  function SortByVisitsTime(){
    $database = new MySqlObject();
    $costumerVisitsCount = array();
    $index = 0;
    foreach ($_SESSION['reservations'] as $value){
      $queryResult = $database->GetCostumersVisitCount($value['clientNameAndSurname']);
      $visits= new VisitsModel($value['clientNameAndSurname'], $queryResult);
      $costumerVisitsCount[$index++] = $visits;
    }
    $size = count($costumerVisitsCount)-1;
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-$i; $j++) {
            $k = $j+1;
            if ((int)$costumerVisitsCount[$k]->visitsCount > (int)$costumerVisitsCount[$j]->visitsCount) {
                list($costumerVisitsCount[$j], $costumerVisitsCount[$k]) = array($costumerVisitsCount[$k], $costumerVisitsCount[$j]);
            }
        }
    }
    if(count($costumerVisitsCount) - 1 > 0){
    $newReservationArray = array_fill(0, count($costumerVisitsCount) - 1, '');
    for($i = 0; $i < count($costumerVisitsCount) - 1;$i++){
     for($j = 0; $j < count($costumerVisitsCount) - 1; $j++){
       if($costumerVisitsCount[$i]->customerName == $_SESSION['reservations'][$j]['clientNameAndSurname']){
         $newReservationArray[$i] = $_SESSION['reservations'][$j];
       }
     }
    }
    $_SESSION['reservations'] = $newReservationArray;
  }
  }
}