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

	//create user with pass and name
	$db->createUSer($params['user'],$params['pass']);

	//redirect to create user page
	header("Location: index_user.php?message=User created");
}
else{

	//if exist, redirect to create user page with message
	header("Location: index_user.php?message=User exist");

}



?>