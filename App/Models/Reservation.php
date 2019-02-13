<?php

class Reservation
{
		private $uName = "";
		private $uSurname = "";
    
    public function __construct($name, $surname)
    {
				$this->uName = $name;
				$this->uSurname = $surname;
		}
}

