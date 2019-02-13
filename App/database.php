<?php
//include 'config.php';

class MySqlObject
{
  function __construct(){
    
  }

  public function select($query){
    $conn = new mysqli("localhost", "root", "","nfqprojectdatabase");
	  if ($conn->connect_error) {
		  die("connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($query);
    return $result;
  }

  function insert($query){

  }

  function update($query){

  }

  function delete($query){

  }
}

?>