<?php

//class alarm: define the alarm object
class alarm{

	public $name;
	public $priority;
	public $expireDate;
	public $userID;//this is the id of user owner of this alarm
	public $id;// this is the id of alarm in the db

	function __construct($values){ //constructor to define values of alarm parameters. The inputs are in an array with name of parameters

		$this->name = $values['name'];
		$this->priority = $values['priority'];
		$this->expireDate = $values['expireDate'];
		$this->userID = $values['userID'];
		$this->id = $values['id'];

	}


}


?>