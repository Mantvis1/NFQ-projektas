<?php
//include 'config.php';

class MySqlObject{ 
  var $conn = "";
  function __construct(){

  }
  
  function MySqlObject(){
    $this->conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
    if ($this->conn->connect_error){
    die("connection failed: " . $conn->connect_error);
    }
    return $this->conn;
  }

  public function checkIfUserWasRegistred($nameAndSurname){
    $conn = $this->MySqlObject();
    $query = "SELECT Count(id) from reservations where clientNameAndSurname = "."'$nameAndSurname'";
    $result = $this->conn->query($query);
    return $result;
  }

  public function checkUserRegistrationInfo($nameAndSurname){
    $conn = $this->MySqlObject();
    $query = "SELECT startTime,startDay, haircutter.name
    FROM reservations
    INNER JOIN haircutter
    ON reservations.haircutterId = haircutter.id
    WHERE reservations.clientNameAndSurname = "."'$nameAndSurname' ";
    $result = $conn->query($query);
    return $result;
  }

  public function cancelRegistration($nameAndSurname){
    $conn = $this->MySqlObject();
    $query = "DELETE FROM reservations WHERE clientNameAndSurname = "."'$nameAndSurname' ";
    return $conn->query($query);
  }

  public function getLoyalCustomers(){
    $conn = $this->MySqlObject();
    $query = "SELECT clientNameAndSurname,visitsCount FROM visits ORDER by visitsCount ASC";
    $result = $conn->query($query);
    return $result;
  }

  public function findCostumersVisitsCountByName($nameAndSurname){
    $conn = $this->MySqlObject();
    $query = "SELECT visitsCount FROM visits WHERE clientNameAndSurname= "."'$nameAndSurname' ";
    $result = $conn->query($query);
    return $result;
  }

  public function GetAllHaircutters(){
    $conn = $this->MySqlObject();
    $query = "SELECT * FROM haircutter";
    $result = $conn->query($query);
    return $result;
  }

  public function CheckIfTimeIsFree($startDay, $startTime,$haircutterId){
    $conn = $this->MySqlObject();
    $query ="SELECT COUNT(ID) FROM reservations WHERE startDay = '".$startDay."' and startTime = '".$startTime."' and haircutterId=".$haircutterId;
    $result = $conn->query($query);
    return $result;
  }

  public function GetHaircutterIdByName($name){
    $conn = $this->MySqlObject();
    $query = "SELECT id FROM haircutter where name='".$name."'";
    $result = $conn->query($query);
    return $result;
  }

  function insertNewReservation($nameAndSurname, $startDay, $startTime,$haircutterId){
    $conn = $this->MySqlObject();
    $query = "INSERT INTO reservations VALUES (NULL, '".$nameAndSurname."', '".$startDay."','".$startTime."',".$haircutterId.")";
    $result = $conn->query($query);
    if($result == true){
      return "Registracija sekminga";
    }else {
      return "Registracija nesekminga";
    }
  }

    function CreateNewUserVisitsCountTable($nameAndSurname){
      $conn = $this->MySqlObject();
      $query= "INSERT INTO visits VALUES (NULL,'".$nameAndSurname."',1)";
      $result = $conn->query($query);
    }

    function CheckIfUserExsitsInVisitsTable($nameAndSurname){
      $conn = $this->MySqlObject();
        $query= "SELECT COUNT(id) FROM visits WHERE clientNameAndSurname = '".$nameAndSurname."'";
        $result = $conn->query($query);
        return $result;
    }

    function UpdateUserVisitsTable($nameAndSurname){
      $conn = $this->MySqlObject();
      $query = "UPDATE visits SET visitsCount=visitsCount+1 WHERE clientNameAndSurname = '".$nameAndSurname."';";
      $result = $conn->query($query);
    }

    function UpdateUserVisitsTableAfterCancel($nameAndSurname){
      $conn = $this->MySqlObject();
      $query = "UPDATE visits SET visitsCount=visitsCount-1 WHERE clientNameAndSurname = '".$nameAndSurname."';";
      $result = $conn->query($query);
    }

    function IfHaircutterExists($nameAndSurname)
    {
      $conn = $this->MySqlObject();
      $query= "SELECT Count(id) FROM haircutter where name = '".$nameAndSurname."'";
      $result = $conn->query($query);
      return $result;
    }  

    function GetAllReservations($id){
      $conn = $this->MySqlObject();
      $query = "SELECT clientNameAndSurname,startDay,startTime FROM reservations Where haircutterId =".$id;
      $result = $conn->query($query);
      return $result;
    }

    function GetCostumersVisitCount($nameAndSurname){
      $conn = $this->MySqlObject();
      $query = "SELECT visitsCount FROM visits WHERE clientNameAndSurname = '".$nameAndSurname."'";
      $result = $conn->query($query);
      while($row = $result->fetch_assoc()){
          return $row["visitsCount"];
      }
    }
}

?>