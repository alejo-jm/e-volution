<?php

//dashboard to create user, this file is loaded with ajax

//enable session variables
session_start();

//call db class file
require_once('../dbs.php');

//get login user from session variable
$user = json_decode($_SESSION['user']);

//create db element
$db = new dbs('../db');

//get actual date
$date = date('Y-m-d');

?>

<html>
	<body>
		<!--div wich content is all operation page-->
		<div class="container" style="margin-top: 2%;margin-left: 10%" >
			<h2>Users</h2>

			<!--form to create user-->
			<form role="form" action="createUser.php" id = "formuser" method="post">
				<div class="form-group">
					<label for="email">Email:</label>

					<!--input to write email of new user or user to delete, this input check if the user wrote is the login user
						in this case, appear warning message and delete email input content. The verification is in checkActualUser()-->
					<input type="email" class="form-control" id="user" placeholder="Enter email" name="user" onchange="checkActualUser()">
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<!--input to write the pass, if the pass and confirm pass not match, the confirm pass input change its color and create button is disabled, the verification is in checkPass()-->
					<input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass" onchange="checkPass()">
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<!--input to write the confirm pass, if the pass and confirm pass not match, the confirm pass input change its color and create button is disabled, the verification is in checkPass()-->
					<input type="password" class="form-control" id="passConfirm" placeholder="Enter password" name="passConfirm" onchange="checkPass()">
				</div>
				<button type="submit" class="btn btn-primary" id = "actionForm">Create</button><!--button to create user submiting the form content-->
				<button type="button" class="btn btn-dark" id = "deleteForm" onclick = "deleteUser()">Delete</button><!-- button to delete user with deleteUSer() function -->
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#info">Info</button><!-- button to show info about deleting users-->

			</form>
		</div>
		
	</body>

</html>

<!--modal window to show info about deleting user-->
<div class="modal fade" id="info" role="dialog">
  <div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><!--button to close window-->
        <h4 class="modal-title">Info</h4>
      </div>
      <div class="modal-body">
        <p>To delete user, write the email of the user in the field Email and press delete</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><!--button to close window-->
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">

	//function to delete user
	function deleteUser(){

		//check if email field isn't empty
		if($("#user").val().length > 0){

			//change url to send form fields to delete usrl script
			$("#formuser").attr("action","deleteUser.php");

			//send form fields to delete url
			$("#formuser").submit();
		}
		else{
			//if email field is empty appear message in emergent window
			alert("Write some email");
		}
		

	}

	//function to check if pass and confirm pass match
	function checkPass(){

		//check if pass is equal to confrim pass
		if($("#pass").val() == $("#passConfirm").val()){

			//enable create button
			$("#actionForm").removeAttr("disabled");

			//retore initial color of confirm pass field
			$("#passConfirm").css("background-color","#fff");
		}

		//if pass and confirm pass not match
		else{
			//disabled create button
			$("#actionForm").attr("disabled","disabled");

			//change color of pass confirm field
			$("#passConfirm").css("background-color","#ffb3b3");

		}
	}

	//function to check if email wrote exist in db
	function checkActualUser(){

		//get login user
		var actualUser = '<?php echo $user->user; ?>';

		//if login user is equal to wrote user
		if(actualUser == $("#user").val()){

			//clean email field
			$("#user").val('');

			//show message that you can't write your user email
			alert("You can't delete or create your self");
		}

	}
</script>

