<?php
    //declaring connection variables;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donate_db";
    $con = mysqli_connect($servername, $username,$password, $dbname);

    //testing for connection failure;
    if (!$con){
        die("Connection failed: ".mysqli_connect_error());
    }
?>