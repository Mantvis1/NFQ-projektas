<?php
session_start();
include '../database.php';
include '../Models/visitsModel.php';
$controller = new haircutterController();

class haircutterController{

  function __construct(){
    if(isset($_POST['userSearch'])){
      $this->foundCostumersInfo();
    }else if(isset($_POST['postHaircutterName'])){
      $this->loadHairCutterMeniu();
    }else if(isset($_POST['findInfoAboutOneCustomer'])){
      $this->getInfoAboutCustomers();
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
  

}