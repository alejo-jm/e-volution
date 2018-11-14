<?php
//dashboard to manage alarms, this file is loaded with ajax

//enable session variables
session_start();


//call db class file
require_once('../dbs.php');

//get login user from session variable
$user = json_decode($_SESSION['user']);

//create db element
$db = new dbs('../db');

//get alarms of login user
$alarms = $db->queryAlarms($user->id);

//get actual date
$date = date('Y-m-d');

?>

<html>
	<body>

		<!--div wich content is all operation page-->
		<div style="margin-top: 2%;margin-left: 10%">
			<h5>Expired alarms</h5>

			<!-- div to content expired alarms (bootstrap and custom css classes) -->
			<div class="well table-alarms">

				<!--table to list expired alarms-->
				<table class="table expired-table">

					<!--table titles-->
				    <thead>
				      <tr>
				        <th>Title</th>
				        <th>Priority</th>
				        <th>Expired date</th>
				        <th>Update</th>
				        <th>Remove</th>
				      </tr>
				    </thead>

				    <!--table body-->
				    <tbody>
				      <?php

				      	//check if there are alarms of this user
				      	if($alarms){

				      		//loop for each alarm
				      		foreach ($alarms as $alarm) {

				      			//check if alarm is expired
					      		if($alarm->expireDate<=$date){
						      		echo "<tr>";
						      			//print alarm data in different table columns
						      			echo "<td>".$alarm->name."</td>";
						      			echo "<td>".$alarm->priority."</td>";
						      			echo "<td>".$alarm->expireDate."</td>";

						      			//print icon to open alarm edit modal window with actual data
						      			echo "<td><a href='#' ><i class='fas fa-edit' onclick = 'editAlarm(".json_encode($alarm).")'></i></a></td>";

						      			//print icon to delete alarm
						      			echo "<td><a href='#'><i class='fas fa-trash-alt' onclick = 'removeAlarm(".json_encode($alarm).")'></i></a></td>";
					      			echo "</tr>";
					      		}
					      	}
				      	}
				      	
				      ?>
				    </tbody>
			  	</table>
			</div>
			<h5>Alarms in next 10 days</h5>

			<!-- div to content soon alarms (bootstrap and custom css classes) -->
			<div class="well table-alarms">

				<!--table to list expired alarms-->
				<table class="table">

					<!--table titles-->
				    <thead>
				      <tr>
				        <th>Title</th>
				        <th>Priority</th>
				        <th>Expired date</th>
				        <th>Update</th>
				        <th>Remove</th>
				      </tr>
				    </thead>

				    <!--table body-->
				    <tbody>
				      <?php

				      //check if there are alarms of this user
				      	if($alarms){

							//loop for each alarm
					      	foreach ($alarms as $alarm) {

					      		//check if alarm is soon to expired (next 10 days)
					      		if($alarm->expireDate>$date && $alarm->expireDate<date('Y-m-d', strtotime($date. ' + 10 days'))){
						      		echo "<tr>";
						      			//print alarm data in different table columns
						      			echo "<td>".$alarm->name."</td>";
						      			echo "<td>".$alarm->priority."</td>";
						      			echo "<td>".$alarm->expireDate."</td>";

						      			//print icon to open alarm edit modal window with actual data
						      			echo "<td><a href='#' ><i class='fas fa-edit' onclick = 'editAlarm(".json_encode($alarm).")'></i></a></td>";
						      			//print icon to delete alarm
						      			echo "<td><a href='#'><i class='fas fa-trash-alt' onclick = 'removeAlarm(".json_encode($alarm).")'></i></a></td>";
					      			echo "</tr>";
					      		}
					      	}
				      	}
				      ?>
				    </tbody>
			  	</table>

			</div>
			<h5>Other alarms</h5>

			<!-- div to content expired alarms (bootstrap and custom css classes) -->
			<div class="well table-alarms">

				<!--table to list other alarms-->
				<table class="table">

					<!--table titles-->
				    <thead>
				      <tr>
				        <th>Title</th>
				        <th>Priority</th>
				        <th>Expired date</th>
				        <th>Update</th>
				        <th>Remove</th>
				      </tr>
				    </thead>

				    <!--table body-->
				    <tbody>
				      <?php

				      //check if there are alarms of this user
				      	if($alarms){

				      		//loop for each alarm
					      	foreach ($alarms as $alarm) {

					      		//check if alarm is away to expired
					      		if($alarm->expireDate>=date('Y-m-d', strtotime($date. ' + 10 days'))){
						      		echo "<tr>";

						      			//print alarm data in different table columns
						      			echo "<td>".$alarm->name."</td>";
						      			echo "<td>".$alarm->priority."</td>";
						      			echo "<td>".$alarm->expireDate."</td>";

						      			//print icon to open alarm edit modal window with actual data
						      			echo "<td><a href='#' ><i class='fas fa-edit' onclick = 'editAlarm(".json_encode($alarm).")'></i></a></td>";

						      			//print icon to delete alarm
						      			echo "<td><a href='#'><i class='fas fa-trash-alt' onclick = 'removeAlarm(".json_encode($alarm).")'></i></a></td>";
					      			echo "</tr>";
					      		}
					      	}
				      	}
				      ?>
				    </tbody>
			  	</table>

			</div>

			<!--button to create alamr -->
		  	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createModal">Create</button>

		</div>
		
	</body>

	<!-- Modal window to create alarm-->
  <div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><!--button to close window-->
          <h4 class="modal-title">Create alarm</h4>
        </div>

        <!--form to send info to create alarm script-->
        <form action="createAlarm.php" method="post">
	        <div class="modal-body">
	          <div class="container">
				    <div class="form-group">
				      <label for="Name">Name:</label>
				      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
				    </div>
				    <div class="form-group">
				      <label for="priority">Priority:</label>

				      <!--input to set priority, only numbers-->
				      <input type="number" class="form-control" id="priority" placeholder="Enter priority" name="priority">
				    </div>
				    <div class="form-group">
				      <label for="ExpiredDate">Date to expired:</label>

				      <!--input to set expire date, only date-->
				      <input type="date" class="form-control" id="expireDate" placeholder="Enter date" name="expireDate">
				    </div>			  
				</div>
	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-default">Create</button><!--button to send form content to create alarm script-->
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><!--button to close window-->
	        </div>

	        <!--hidden field to store and send user id of login user to create alarm script -->
	        <input type="hidden" name="userID" value = "<?php echo $user->id; ?>">
        </form>
      </div>
      
    </div>
  </div>

  <!-- modal window to edit selected alarm-->
  <div class="modal fade" id="editAlarm" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><!--button to close window-->
          <h4 class="modal-title">Edit alarm</h4>
        </div>

        <!--form to send info to create alarm script-->
        <form action="editAlarm.php" method="post" id="editA" name = "editA">
	        <div class="modal-body">
	          <div class="container">
				    <div class="form-group">
				      <label for="Name">Name:</label>
				      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value = "">
				    </div>
				    <div class="form-group">
				      <label for="priority">Priority:</label>

				      <!--input to set priority, only numbers-->
				      <input type="number" class="form-control" id="priority" placeholder="Enter priority" name="priority" value = "">
				    </div>
				    <div class="form-group">
				      <label for="ExpiredDate">Date to expired:</label>

				      <!--input to set expire date, only date-->
				      <input type="date" class="form-control" id="expireDate" placeholder="Enter date" name="expireDate" value = "">
				    </div>			  
				</div>
	        </div>
	        <div class="modal-footer">
	          <button type="submit" class="btn btn-default">Update</button><!--button to send form content to edit alarm script-->
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><!--button to close window-->
	        </div>

	        <!--hidden field to store and send user id of login user to create alarm script -->
	        <input type="hidden" id = "userID" name="userID" value = "<?php echo $user->id; ?>">

	        <!--hidden field to store and send alarm db id to edit alarm script -->
	        <input type="hidden" id = "id" name="id" value = "">
        </form>
      </div>
      
    </div>
  </div>

</html>

<script type="text/javascript">

	//edit alarm function with selected alarm object as parameter
	function editAlarm(arr){

		//get all inputs into eedit alarm form in modal window
		var inputs = document.forms["editA"].getElementsByTagName("input");

		//loop for each input in form
		for(k in inputs){

			//set in each input the alarm obejct parameter
			inputs[k].value = arr[inputs[k].id];
		}

		//show modal edit alarm window
		$("#editAlarm").modal();
	}

	//function to remove alarm with selected alarm as parameter
	function removeAlarm(arr){

		//confirm window to delete alarm
		if(confirm("Remove this alarm?")){

			//create element form to send alarm info to delete alarm script
			var f = document.createElement("FORM");

			//set attribute method as post in the new from
		    f.setAttribute("method", "post");

		    //set attribute action as delete alarm url in the new from
	        f.setAttribute("action", "deleteAlarm.php");

	        //create element input to store alarm db id info
			var inputid = document.createElement("INPUT");

			//set attribute name as id in the new input to send to delete alarm script
			inputid.setAttribute("name", "id");

			//set value of new input to send to delete alarm script
			inputid.setAttribute("value", arr['id']);

			//create element input to store alarm user id info
			var inputuserid = document.createElement("INPUT");
			
			//set attribute name as userID in the new input to send to delete alarm script
			inputuserid.setAttribute("name", "userID");
			
			//set value of new input to send to delete alarm script
			inputuserid.setAttribute("value", arr['userID']);

			//append input created elements to created form
			f.appendChild(inputid);
			f.appendChild(inputuserid);

			//add form to page body to send 
			document.body.appendChild(f);

			//send new form info to delete alarm script
			f.submit();
		}

	}
</script>

