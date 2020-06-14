<?php 
    $server = "127.0.0.1";
    $user = "root";
    $password = "";
    $dbname = "php_blog";

    $conn = mysqli_connect($server, $user, $password, $dbname);
    if(!$conn){
        die("Connection faild".mysqli_connect_error());
    }
    else{
       
    }
?>