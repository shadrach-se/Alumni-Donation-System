<?php
    session_start();
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    require("dbconnect.php");
    $userid = $_SESSION["userDetails"]["id"];
    foreach ($_POST as $key => $value){
        $sql1 = "select * from request where donationid = '$key' && userid = '$userid'";
    }
    $res1 = mysqli_query($con, $sql1);
    if (mysqli_num_rows($res1) == 1){
        $_SESSION["reqexists"] = "The request has been submitted previously. You can submit only once.";    
    } else {
        $sql2 = "insert into request (userid, donationid) values ('$userid', '$key')";
        $res = mysqli_query($con, $sql2);
        $_SESSION["requestsuccess"] = "Request has been submitted successfully.";
    }
    header("location:dashboard_student.php");
?>

