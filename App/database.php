<?php
//include 'config.php';

class MySqlObject
{
  function __construct(){
    
  }

  public function checkIfUserWasRegistred($nameAndSurname){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT Count(id) from reservations where clientNameAndSurname = "."'$nameAndSurname'";
    $result = $conn->query($query);
    return $result;
  }

  public function checkUserRegistrationInfo($nameAndSurname){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT startTime, haircutter.name
    FROM reservations
    INNER JOIN haircutter
    ON reservations.haircutterId = haircutter.id
    WHERE reservations.clientNameAndSurname = "."'$nameAndSurname' ";
    $result = $conn->query($query);
    return $result;
  }

  public function cancelRegistration($nameAndSurname){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "DELETE FROM reservations WHERE clientNameAndSurname = "."'$nameAndSurname' ";
    return $conn->query($query);
  }

  public function getLoyalCustomers(){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT clientNameAndSurname,visitsCount FROM visits ORDER by visitsCount ASC";
    $result = $conn->query($query);
    return $result;
  }

  public function findCostumersVisitsCountByName($nameAndSurname){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT visitsCount FROM visits WHERE clientNameAndSurname= "."'$nameAndSurname' ";
    $result = $conn->query($query);
    return $result;
  }

  public function GetAllHaircutters(){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT * FROM haircutter";
    $result = $conn->query($query);
    return $result;
  }

  public function CheckIfTimeIsFree($startDay, $startTime,$haircutterId){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query ="SELECT COUNT(ID) FROM reservations WHERE startDay = '".$startDay."' and startTime = '".$startTime."' and haircutterId=".$haircutterId;
    $result = $conn->query($query);
    return $result;
  }

  public function GetHaircutterIdByName($name){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "SELECT id FROM haircutter where name='".$name."'";
    $result = $conn->query($query);
    return $result;
  }

  function insertNewReservation($nameAndSurname, $startDay, $startTime,$haircutterId){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $query = "INSERT INTO reservations VALUES (NULL, '".$nameAndSurname."', '".$startDay."','".$startTime."',".$haircutterId.")";
    $result = $conn->query($query);
    if($result == true){
      return "Registracija sekminga";
    }else {
      return "Registracija nesekminga";
    }
  }
}

?>