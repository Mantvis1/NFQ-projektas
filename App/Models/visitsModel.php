<?php

class VisitsModel{
  public $customerName = '';
  public $visitsCount = '';

  function __construct($cName, $visits){
    $this->customerName = $cName;
    $this->visitsCount = $visits;
  }

}

?>