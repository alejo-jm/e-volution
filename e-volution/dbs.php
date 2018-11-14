<?php

require_once('user.php');//get user class
require_once('alarm.php');//get alarm class

//class dbs: create the db object and contain all methods to interact with db
class dbs{

	private $dbname;//name of database
	private $emessage;//error message
	private $db;// db element

	public function __construct($dbname){// construtor with path of db file as parameter

		$this->dbname = $dbname;

		if(!file_exists ( $this->dbname.".sqlite")){//check if exist db file

			if ($this->db = new SQLite3($this->dbname.'.sqlite')) { //create db file

				//create user table in db
			    $this->db->query( 'CREATE TABLE user (
			    	id integer primary key autoincrement, 
			    	user varchar(10) not null,
			    	pass varchar(30) not null,
			    	dateUpdate datetime default current_timestamp
			    )');

			    //create alarm table in db
			    $this->db->query( 'CREATE TABLE alarm (
			    	id integer primary key autoincrement, 
			    	name varchar(20) not null,
			    	priority integer not null,
			    	expireDate date not null,
			    	userID integer not null,
			    	dateUpdate datetime default current_timestamp
			    )');

			    //insert default user
			    $this->db->query( "INSERT INTO user (user,pass) VALUES ('luisa.gutierrez@e-volution.co','admin')");


			} else {

				//get error message
				$emessage =  $sqliteerror;
			    
			}

		}
		else{

			//if db file exist only open db file and define db element
			if (!$this->db = new SQLite3($dbname.'.sqlite')) { 

				//if an error come up, get the error message
				$emessage = $sqliteerror;
			    
			} 
		}
	}

	//function to validate and get login user 
	function queryUSer($user,$pass){

		$result = $this->db->query("select * from user where user = '".$user."' and pass = '".$pass."';");

		if ($row = $result->fetchArray()) {
		    if(sizeof($row) == 0){
		    	return false;
		    }
		    else{

		    	$user = new user($row['id'],$row['user'],$row['pass'],$row['dateUpdate']);

		    	return $user;

		    }
		}
	}

	//function to check if user exist
	function getUser($user){

		$result = $this->db->query("select * from user where user = '".$user."';");

		if ($row = $result->fetchArray()) {
		    if(sizeof($row) == 0){
		    	return false;
		    }
		    else{

		    	$user = new user($row['id'],$row['user'],$row['pass'],$row['dateUpdate']);

		    	return $user;

		    }
		}
	}

	//function to get all alarms of an specific user order by expired date and priority
	function queryAlarms($idUser){

		$result = $this->db->query( "select * from alarm where userID = '".$idUser."' order by expireDate ASC,priority ASC;");
		$alarms = Array();

		while ($row = $result->fetchArray()) {

			array_push($alarms, new alarm($row));	    	

		}

		if(sizeof($alarms)==0){
			return false;
		}
		else{
			
			return $alarms;
		}
	}

	//function to create user
	function createUser($user,$pass){

	    $this->db->query( "INSERT 
			    OR REPLACE
			INTO
			    user (user,pass)  
			VALUES ('$user','$pass');");

	}

	//function to delet user and all his alarms
	function deleteUser($user){

		$this->db->query( "delete from alarm where userID = (select id from user where user = '$user')");

	    $this->db->query( "delete from user where user = '$user'");

	}

	//function to create alarm
	function createAlarm($name,$priority,$expireDate,$userID){

	    $this->db->query( "INSERT INTO alarm (name,priority,expireDate,userID) VALUES ('$name','$priority','$expireDate','$userID')");

	}

	//function to update alarm's data
	function updateAlarm($name,$priority,$expireDate,$userID,$id){

	    $this->db->query( "UPDATE alarm SET name='$name',priority='$priority',expireDate='$expireDate' WHERE userID = '$userID' AND id = '$id'");

	}

	//function to delete alarm
	function deleteAlarm($id,$userID){

	    $this->db->query( "delete from alarm where userID = '$userID' and id = '$id'");

	}

	//function to return the false message, return false when there isn't message
	function getemessage(){
		if(isset($emessage)){
			return $emessage;
		}
		else return false;
	}
	
}

?>