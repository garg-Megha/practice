
<?php


session_start();

?>


<!DOCTYPE html>
<html>
<head>
<title>Register, login and logout user php mqsql</title>
<link rel="stylesheet" type ="text/css" href="style.css">
</head>
<body>
<div class="header">
 <h1>Register, login and logout user php mysql</h1>
 </div>
 <?php
 if(isset($_SESSION['message'])){
	 echo "<div id= 'error_msg' >" .$_SESSION['message']."</div>";
	 //unset($_SESSION['message']);
 } 
 ?>
 
 
 
  <h1>Home</h1>
  <div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
  <div><a href="logout.php">Logout</div>
 </body>
 </html>