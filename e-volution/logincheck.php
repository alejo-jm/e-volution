<?php

require_once('dbs.php');//call db class file

//method to enable session variables
session_start();

//get login user data from login window
$user = $_POST['user'];
$pass = $_POST['pass'];

$db = new dbs('db');//create db element

$errorDB = $db->getemessage();//check if there is errors

//if there is errors
if($errorDB != false){
	//return to login page with error message
	header('Location: index.php?error='.$errorDB);

}

//get login user
$user = $db->queryUser($user,$pass);

//check if login user exist
if(is_null($user)){
	//if not exist, return to login page with error message
	header('Location: index.php?error=user not found');
}
else{

	//if exist set session variable with user found
	$_SESSION['user'] = json_encode($user);

	//go to profile page
	header("Location: profile/index_profile.php");

}


?>
