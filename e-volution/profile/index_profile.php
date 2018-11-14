<?php
//main page to manage alarms

//enable session variables
session_start();

//check if session user is set
if(!isset($_SESSION['user'])){

	//if session user isn't set redirect to login page with message
	header('Location: index.php?error=session time out');
}

//get user from session variable
$user = json_decode($_SESSION['user']);

?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--libs and sources to implement in this page included the ajax page-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="profile.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"/>
</head>

<body>
	<div>

		<!--side bar in the left of screem with css class-->
	    <div class="sidenav">

	    	<!--show options of sidebar in list-->
	    	<ul>
	            <li >

	            	<!-- icon-item to go to login page-->
	                <a href="../index.php">
	                	<i class="fas fa-home"></i>
	                	<span class="sidenavspan">Home</span>
	                </a>	                
	            </li>
	            <li>

	            	<!-- icon-item to go to users page-->
	                <a href="../users/index_user.php"">
	                	<i class="fas fa-users"></i>
	                	<span class="sidenavspan">Users</span>
	                
	            </a>
	            </li>
	        </ul>
			
		</div>

		<!--container of ajax page-->
		<div id="dash">
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	
	//ajax load page in ajax container
	$.ajax({
		mimeType: 'text/html; charset=utf-8',
		url: 'dash_profile.php',//ajax file target
		type: 'GET',//method to call ajax file
		dataType: "html",
		async: false,
		success: function(result){
			$("#dash").html(result);//set content of ajax container with ajax file content
		}
   	});

</script>