<?php

//connect to database
require 'include/connect.inc.php';
session_start();
if(isset($_SESSION['id'])){
	header("location: home.php");
}
if (isset($_POST['username'])&&isset($_POST['password'])){
	$username = trim(htmlentities($_POST['username']));
	$password = trim(htmlentities($_POST['password']));
	if(!empty($username)&&!empty($password)){
		$password = md5($password);  //remember we hashed password before storing last time
	  $sql = "SELECT * FROM users WHERE username = '$username' AND password='$password'";
	  $result = mysqli_query($db, $sql);
	  if(mysqli_num_rows($result) == 1)
	  {
			$row = mysqli_fetch_array($result);
			//print_r($row);
		  $_SESSION['username'] = $username;
			$_SESSION['id'] = $row['id'];
			//echo  $_SESSION['id'];
			//echo $row['id'];

		  $_SESSION['message'] = "you are now logged in";
		  header("location: home.php"); //redirect to home page
		  //echo 'OK';
	  }
	  else
	  {
		  $_SESSION['message'] = "Username/ password combination invalid";
		}
	} else {
		$_SESSION['message'] = "Empty Field";
	}
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Register, login and logout user php mqsql</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<h1>Register, login and logout user php mysql</h1>
		</div>

		 <?php
		 if(isset($_SESSION['message'])){
			 echo"<div id='error_msg'>". $_SESSION['message']."</div>";
			 //unset($_SESSION['message']);
		 } else {
		 	echo "<div id = 'message' class = 'callout callout-info'>".'Please enter your username and password.'."</div>";
		 }
		 ?>

		<div class="container">

			<div class="row">
				<div class="col-sm-4 col-sm-offset-4 col-xs-12">
					<div class="row">

					</div>
					<div class="row">
						<div id="msg" class="callout callout-info"><p>Please enter your username and password</p></div>
					</div>
					<div class="row">
						<form id="login" data-error="<?php if(isset($_SESSION['message'])){ echo 'true'; unset($_SESSION['message']);} else {echo 'false';}?>" action="login.php" method="post">
				        	<div class="form-group">
				        		<label for="username" class="control-label" >Username</label>
				          		<input id="username" name="username" class="form-control"  placeholder = "Username" type="text">
								<p class="help-block"></p>
				        	</div>
				        	<div class="form-group">
				          		<label for="password" class="control-label" >Password</label>
				          		<input id="password" name="password" class="form-control" placeholder = "Password" type="text">
								<p class="help-block"></p>
				        	</div>
				    		<button id="submit" value="Login" name="login_btn" type="submit"> Login</button>
				     	</form>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
			$(document).ready(function () {
				var callout = $('#msg');
				var elem = $("<i class='fa fa-times-circle-o'></i>");
				//$('#password').closest('div').find('label').prepend(elem);
				if ($('#login').data('error')){
					$(callout).addClass('callout-danger');
					$(callout).find('p').text('hi');
					var error = $(this).find('div:last');
					$(error).find('label').prepend(elem);
					$(error).addClass('login-error');
				} else {

				}
			});
		</script>

	 </body>
 </html>
