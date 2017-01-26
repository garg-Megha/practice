
<?php
session_start();
require 'include/connect.inc.php';
if(!isset($_SESSION['id'])){
	header("location: login.php");
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
             echo "<div id= 'error_msg' >" .$_SESSION['message']."</div>";
             //unset($_SESSION['message']);
         } 
         ?>



          <h1>Home</h1>
          <div><h4>Welcome <?php echo $_SESSION['username']; ?></h4></div>
          <div><a href="logout.php">Logout</div>
    </body>
 </html>