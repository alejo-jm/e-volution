<?php 

//class user: define the user object
class user{

	public $id;//id of user in db
	public $user;
	public $pass;
	public $createDate;//create date of user in db

	function __construct($id,$user,$pass,$createDate){//constructor to define intern parameters values
		$this->id = $id;
		$this->user = $user;
		$this->pass = $pass;
		$this->createDate = $createDate;
	}

	
}