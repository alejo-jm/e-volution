<?php

//get post parameters to create user and put them in array 
foreach ($_POST as $key => $value) {
	$params[$key] = $value;
}

//require db file
require_once('../dbs.php');

//create db element
$db = new dbs('../db');

//delete alarm in database 
$db->deleteAlarm($params['id'],$params['userID']);

//redirect to alarms page
header("Location: index_profile.php");

?>