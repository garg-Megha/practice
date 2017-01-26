
<?php
//connect to database
require 'include/connect.inc.php';
session_start();
$signup_username_error = $signup_contact_error = $signup_password_error = $signup_email_error = "";
if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])){
	$username = trim(mysqli_real_escape_string($db,$_POST["username"]));
	$Contact = trim(mysqli_real_escape_string($db, $_POST["contact"]));
	$email = trim(mysqli_real_escape_string($db,$_POST['email']));
	$password = trim(mysqli_real_escape_string($db,$_POST['password']));
	$password2 = trim(mysqli_real_escape_string($db,$_POST['password2']));
    if(!empty($username)&&!empty($password) && !empty($email) && !empty($Contact)){
            $signup=1;
            if(strlen($username)>10){
                $signup_username_error = ' Username must be less than 10 characters.';
                $signup=0;
            }
			/*if(strlen($Contact)!=10)
			{
				$signup_contact_error = 'please enter valid contact number';
				$signup=0;
			}*/

            /*if(strlen($password)>20||strlen($password)<8){
                $signup_password_error = ' Password must be 8-20 characters.';
                $signup=0;
            }*/
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $signup_email_error = "Invalid email format";
                 $signup =0;
			 }
			 if($signup)
			 {
				 $sql = "SELECT username FROM users WHERE username= '$username'";
				 $result = mysqli_query($db, $sql);
				 $num = mysqli_num_rows($result);
				 if($num!=0){
					 die("there is user with that username");
				 }
				else{
		            if($password == $password2)
					{  //create user
					$password = md5($password); // hash pashword before storing for secority purpose
					$sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
					mysqli_query($db, $sql);
					echo "OK";
					$_SESSION['message'] = "You are now logged in" ;
					$_SESSION['username'] = $username;
					//header("location: home.php");  // redirect to home apge

	               }
                   else
					{
					$_SESSION['message'] = "The two passwords do not match";

					}
		}
		}
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
		 unset($_SESSION['message']);
	 }
	 ?>

	 <div class="container">
		 <div class="row form-row">
			 <div class="col-sm-4 col-sm-offset-4 col-xs-12">
				 <div class="row">

				 </div>
				 <div class="row">
					 <div id="msg" class="callout"><p></p></div>
				 </div>
				 <div class="row">
					 <form id="signup" action="register.php" method="post">
						 <div class="form-group">
							 <label for="username" class="control-label" >Username</label>
							 <input id="username" name="username" class="form-control"  placeholder = "Username" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="firstname" class="control-label" >Firstname</label>
							 <input id="firstname" name="firstname" class="form-control" placeholder = "Firstname" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="lastname" class="control-label" >Lastname</label>
							 <input id="lastname" name="lastname" class="form-control" placeholder = "Lastname" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="email" class="control-label" >Email</label>
							 <input id="email" name="email" class="form-control" placeholder = "Email" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="password" class="control-label" >Password</label>
							 <input id="password" name="password" class="form-control" placeholder = "Password" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="password2" class="control-label" >Confirm Password</label>
							 <input id="password2" name="password2" class="form-control" placeholder = "Confirm Password" type="text">
							 <p class="help-block"></p>
						 </div>
						 <div class="form-group">
							 <label for="contact" class="control-label" >Contact No</label>
							 <input id="contact" name="contact" class="form-control" placeholder = "Contact No" type="text">
							 <p class="help-block"></p>
						 </div>
						 <button id="submit" value="register" name="register_btn" type="submit"> Login</button>
					 </form>
				 </div>
			 </div>
		 </div>
	 </div>
 </body>
 </html>
