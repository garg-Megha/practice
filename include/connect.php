<?php
    //create a file connect.inc.php in include folder and paste the following code.
    //update configuration.
    $hostname='localhost'; //hostname
    $username=''; //username of user
    $password=''; //password of user
    $database=''; //database name
    if(!@($connect = mysqli_connect($hostname,$username,$password,$database))){
        echo 'Try after sometime. Sorry for the inconvenience.';
        die();
    }
?>
