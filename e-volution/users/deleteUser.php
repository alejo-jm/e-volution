<?php


//get post parameters to create user and put them in array 
foreach ($_POST as $key => $value) {
	$params[$key] = $value;
}

//require db file
require_once('../dbs.php');

//create db element
$db = new dbs('../db');


//check if received user exist
$user = $db->getUser($params['user']);


//if not exist
if($user == false){

	//if not exist, redirect to create user page with message
	header("Location: index_user.php?message=User not exist");
	
}
else{


	//delete user
	$db->deleteUser($params['user'],$params['pass']);


	//redirect to create user page with message
	header("Location: index_user.php?message=User deleted");

}



?>