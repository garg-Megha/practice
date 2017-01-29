
<?php
//connect to database
require 'include/connect.inc.php';
session_start();
$signup_username_error = $signup_contact_error = $signup_password_error = $signup_email_error = "";
if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])){
	$username = trim(mysqli_real_escape_string($db,$_POST["username"]));
	//$Contact = trim(mysqli_real_escape_string($db, $_POST["contact"]));
	$email = trim(mysqli_real_escape_string($db,$_POST['email']));
	$password = trim(mysqli_real_escape_string($db,$_POST['password']));
	$password2 = trim(mysqli_real_escape_string($db,$_POST['password2']));
    if(!empty($username)&&!empty($password) && !empty($email) ){
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
               $signup_email_error = "Invalid email format $email";
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
					if(mysqli_query($db, $sql)){
                        echo "OK";
					$_SESSION['message'] = "You are now logged in" ;
					$_SESSION['username'] = $username;
					//header("location: home.php");  // redirect to home apge
                    } else{
                        echo 'error';
                }


	               }
                   else
					{
					$_SESSION['message'] = "The two passwords do not match";
                        echo 'not same password';
					}
		          }
		  } else{
                 echo 'invalid format';
             }
	} else{
        echo 'empty';
    }
} else{
    //echo '1';
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
						 </div>
						 <div class="form-group">
							 <label for="firstname" class="control-label" >Firstname</label>
							 <input id="firstname" name="firstname" class="form-control" placeholder = "Firstname" type="text">
						 </div>
						 <div class="form-group">
							 <label for="lastname" class="control-label" >Lastname</label>
							 <input id="lastname" name="lastname" class="form-control" placeholder = "Lastname" type="text">
						 </div>
						 <div class="form-group">
							 <label for="email" class="control-label" >Email</label>
							 <input id="email" name="email" class="form-control" placeholder = "Email" type="email">
						 </div>
						 <div class="form-group">
							 <label for="password" class="control-label" >Password</label>
							 <input id="password" name="password" class="form-control" placeholder = "Password" type="text">
						 </div>
						 <div class="form-group">
							 <label for="password2" class="control-label" >Confirm Password</label>
							 <input id="password2" name="password2" class="form-control" placeholder = "Confirm Password" type="text">
						 </div>
						 <div class="form-group">
							 <label for="contact" class="control-label" >Contact No</label>
							 <input id="contact" name="contact" class="form-control" placeholder = "Contact No" type="text">
						 </div>
						 <button id="submit" value="register" name="register_btn" type="submit"> Login</button>
					 </form>
				 </div>
			 </div>
		 </div>
	 </div>
    <script src="js/jquery.min.js" type="text/javascript"></script>
		<script src="js/jquery.validate.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
					$.validator.setDefaults({
						highlight: function (element) {
							$(element).closest('.form-group').addClass('has-error');
						},
						unhighlight: function (element) {
							$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
						}
					});
					$.validator.addMethod('checkuser',function(value,element){
						if(value.length>=6&&value.length<=10){
								var result = false;
								var t=0;
								var abc ="vishal";
								$.ajax({
										type: "get",
							      url:"checkuser.php?username="+value,
							      async: false,
							    	success:function(data) {
							    	result = data;
							    }
							  });
								return result;
						} else{
							return true;
						}
					},'Username already taken')
					$('#signup').validate({
						errorElement: "p",
						errorClass: "help-block",
						rules:{
							username: {
								required: true,
								minlength:6,
								maxlength:20,
								remote: {
									url:'checkuser.php',
									type: 'get',
									data: {
										username: function(){return $('#username').val(); }
									}
								}
							},
							firstname: {
								required: true
							},
							lastname: {
								required: true
							},
							email:{
								required: true,
								email: true
							},
							password:{
								required: true,
								minlength: 6,
								maxlength: 30
							},
							password2:{
								required: true,
								equalTo: "#password"
							},
							contact:{
								required: true
							}
						},
						messages:{
							username:{
								remote: 'Username already taken'
							}
						}
					});
        });
    </script>
 </body>
 </html>
