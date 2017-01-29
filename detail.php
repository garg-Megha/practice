<?php
//connect to database
require 'include/connect.inc.php';
if(!$db)
	echo 'error';

if(isset($_POST['submit'])){
	session_start();
	$patient_name = mysqli_real_escape_string($db,$_POST["patient_name"]);
	$patient_age = mysqli_real_escape_string($db,$_POST["patient_age"]);
	$blood_group = mysqli_real_escape_string($db,$_POST["blood_group"]);
	$emergency = mysqli_real_escape_string($db,$_POST["emergency"]);
	$Relative_name = mysqli_real_escape_string($db,$_POST["Relative_name"]);
	$relation = mysqli_real_escape_string($db,$_POST["relation"]);
	$discription =mysqli_real_escape_string($db,$_POST["discription"]);


    $sql = "INSERT INTO patients (patient_name , patient_age, blood_group, emergency, Relative_name, relation, discription)
	VALUES ('$patient_name' , '$patient_age', '$blood_group', '$emergency',  '$Relative_name', '$relation', '$discription')";
     mysqli_query($db, $sql);


	}

?>

<!DOCTYPE html>
<html>
     <head>
	       <title>Patient Details</title>
		   <link rel="stylesheet" type ="text/css" href="style.css">
      </head>
	 <div class="header">
	 <h1> Patient Details</h1>
	 </div>

<body>
<form action="detail.php" method="post">
<table>
<tr>
<td>Patient Name: </td>
<td><input type="text"  name="patient_name" class ="textInput" ></td>
</tr>

<tr>
<td>Age:</td>
<td><input type="text" name="patient_age" class ="textInput"></td>
</tr>

<tr>
<td>Blood group:</td>
<td><input type="text" name="blood_group" class ="textInput"></td>
</tr>

<tr>
<td>Type of Emergency: </td>
<td>
<select name="emergency">
<option value="chest">Chest</option>
<option value="urgent">Urgent</option>
<option value="asthama">Asthama</option>
</td>
</tr>

<tr>
<td>Relative Name</td>
<td><input type="text" name="Relative_name" class ="textInput"></td>
</tr>

<tr>
<td>Relation with patient</td>
<td><input type="text" name="relation" class ="textInput"></td>
</tr>

<tr>
<td>Discription</td>
<td><textarea name="discription" row="10" column="20" ></textarea>  </td>
</tr>

<tr>
<td><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form>
</body>
</html>
