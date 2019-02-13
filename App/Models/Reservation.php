<?php

class Reservation
{
		public $uName = "";
		public $uSurname = "";
    
    public function __construct($name, $surname)
    {
				$this->uName = $name;
				$this->uSurname = $surname;
		}
}

