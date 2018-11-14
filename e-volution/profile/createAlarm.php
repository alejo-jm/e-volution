<?php

//get post parameters to create user and put them in array 
foreach ($_POST as $key => $value) {
	$params[$key] = $value;
}

//require db file
require_once('../dbs.php');


//create db element
$db = new dbs('../db');

//create alarm in database asociating it with login user
$db->createAlarm($params['name'],$params['priority'],$params['expireDate'],$params['userID']);

//redirect to alarms page
header("Location: index_profile.php");

?>