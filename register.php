
<?php
//connect to database
require 'include/connect.inc.php';
$signup_username_error = $signup_contact_error = $signup_password_error = $signup_email_error = "";
if(!$db){
	echo 'error';
}
if(isset($_POST['register_btn'])){
	session_start();
	$username = mysqli_real_escape_string($db,$_POST["username"]);
	$Contact = mysqli_real_escape_string($db, $_POST["Contact"]);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$password2 = mysqli_real_escape_string($db,$_POST['password2']);


           if(!empty($username)&&!empty($password) && !empty($email) && !empty($Contact)){
            $signup=1;
            if(strlen($username)>10){
                $signup_username_error = ' Username must be less than 10 characters.';
                $signup=0;
            }
			if(strlen($Contact)!=10)
			{
				$signup_contact_error = 'please enter valid contact number';
				$signup=0;
			}

            if(strlen($password)>20||strlen($password)<8){
                $signup_password_error = ' Password must be 8-20 characters.';
                $signup=0;
            }
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
					$_SESSION['message'] = "You are now logged in" ;
					$_SESSION['username'] = $username;
					header("location: home.php");  // redirect to home apge

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
<link rel="stylesheet" type ="text/css" href="style.css">
</head>
<div class="header">
 <h1>Register, login and logout user php mysql</h1>
 </div>


 <?php
 if(isset($_SESSION['message'])){
	 echo"<div id='error_msg'>". $_SESSION['message']."</div>";
	 unset($_SESSION['message']);
 }
 ?>


 <form method="post" action="register.php">
 <table>
 <tr>
 <td>Username:</td>
 <td><input type="text" name="username"  placeholder ="usename(1-10 character)" class="textInput"><?php echo $signup_username_error; ?></td>
 </tr>
 <tr>
 <td>Contact no.</td>
 <td><input type="text" name="Contact" placeholder="number(10 characters)" class="textInput"><?php echo $signup_conatact_error; ?></td>
 </tr>
 <tr>
 <td>Email:</td>
 <td><input type="email" name="email" class="textInput"><?php echo $signup_email_error; ?></td>
 </tr>
 <tr>
 <td>Password:</td>
 <td><input type="password" name="password"  placeholder="password(8-20 characters)" class="textInput"><?php echo $signup_password_error; ?></td>
 </tr>
 <tr>
 <td>Confirm Password:</td>
 <td><input type="password" name="password2" class="textInput"></td>
 </tr>
 <td><input type="submit" name="register_btn" value="Register"></td>
 </tr>
 </table>
 </form>
 </body>
 </html>
