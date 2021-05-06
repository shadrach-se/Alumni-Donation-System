<?php
    session_start();
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    session_abort();
    if ($_SESSION["userDetails"]["status"] == "alumni"){
        include("dashboard_alumni.php");
    } else {
        include("dashboard_student.php");
    }
?>