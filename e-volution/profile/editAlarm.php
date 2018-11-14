<?php

//get post parameters to create user and put them in array 
foreach ($_POST as $key => $value) {
	$params[$key] = $value;
}

//require db file
require_once('../dbs.php');

//create db element
$db = new dbs('../db');

//update alarm in database 
$db->updateAlarm($params['name'],$params['priority'],$params['expireDate'],$params['userID'],$params['id']);

//redirect to alarms page
header("Location: index_profile.php");
 	
?>