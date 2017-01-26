<?php
    $hostname='127.0.0.1'; //hostname
    $username='root'; //username of user
    $password=''; //password of user
    $database='userdatabase'; //database name
    if(!@($db = mysqli_connect($hostname,$username,$password,$database))){
        echo 'Try after sometime. Sorry for the inconvenience.';
        die();
    }
?>
