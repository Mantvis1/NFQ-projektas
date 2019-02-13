<?php
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
    var_dump($visits); // pas model to view
  }
}