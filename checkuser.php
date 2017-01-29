<?php
    require 'include/connect.inc.php';
    session_start();
    if(isset($_GET['username'])&&!empty($_GET['username'])){
        $username = $_GET['username'];
        $sql = "SELECT username FROM users WHERE username= '$username'";
        if($result = mysqli_query($db, $sql)){
            if($result = mysqli_query($db, $sql)){
                if(mysqli_num_rows($result) >0){
                    echo 'false';
                } else{
                    echo 'true';
                }
            } else{
                echo 'false';
            }
        }
    }
?>
