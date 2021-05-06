<?php
    session_start();
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    require("dbconnect.php");
    
    if(isset($_GET['donationId']) && isset($_GET["userId"])){
        $donationId = $_GET["donationId"];
        $userId = $_GET["userId"];
        $sql1 = "select * from request where donationid = '$donationId' && status = '1'";
        mysqli_query($con, $sql1);
        if (mysqli_num_rows($res1) == 0){
            $sql2 = "update request set status = '1' where donationid = '$donationId' && userid = '$userId'";
            $sql3 = "update donation set status = '1' where id = '$donationId'";
            mysqli_query($con, $sql2);
            mysqli_query($con, $sql3);
            $_SESSION["grantsuccess"] = "You have successfully granted item.";
        } else {
            $_SESSION["grantfail"] = "You can only grant one item to one student.";
        }
        header("location:dashboard_alumni_requests.php");
    }
?>