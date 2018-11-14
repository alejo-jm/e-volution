<?php

//variable to get the error message from other scripts

$error = "";
if(isset($_GET['error'])){
  $error = $_GET['error'];
}

?>

<html lang="en">
<head>
  <title>Alarm system</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--libs and sources to implement in this page (bootstrap css classes)-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

    <!--title page-->
    <div class="jumbotron text-center">
      <h1>Alarm system</h1>
      <p>Welcome to your alarms</p> 
    </div>

    <!--container of fields -->
    <div class="container">
      <h2>Login</h2>

      <!-- form to send login user info -->
      <form action="logincheck.php" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="user" placeholder="Enter email" name="user">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pass" placeholder="Enter password" name="pass">
        </div>
        <div class="form-group form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember"> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button><!--button to send form to specific url-->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#info">Info</button><!-- button to show modal window of info-->
      </form>
    </div>
  </body>
</html>


<!--info modal window in div-->
<div class="modal fade" id="info" role="dialog">
  <div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><!--button to close window-->
        <h4 class="modal-title">Info</h4>
      </div>
      <div class="modal-body">
        <p>Write your user and pass. If is the first time in the application try with user luisa.gutierrez@e-volution.co and pass admin</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button><!--button to close window-->
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">

  //procedure to show error message in alert window
  var error = "<?php echo $error; ?>";
  if(error != ""){
    alert(error);
  }
</script>
