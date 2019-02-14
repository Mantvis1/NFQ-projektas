<?php
session_start();
include '../database.php';
include '../Models/visitsModel.php';
$controller = new haircutterController();

class haircutterController{

  function __construct(){
    if(isset($_POST['userSearch'])){
        $this->foundCostumersInfo();
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
}