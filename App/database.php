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
}

?>