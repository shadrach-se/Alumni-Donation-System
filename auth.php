<?php
    if (!isset($_POST["action"])){
        header("location:login.php");
    }
    require("dbconnect.php");
    session_start();
    extract($_POST);
    if (isset($action)){
        if ($action == "login"){
            $sql = "select * from users where matric = '$matric' && password = '$password'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) == 1){
                $_SESSION["userDetails"] = mysqli_fetch_assoc($result);
                header("location:dashboard.php");
            } else {
                $_SESSION["loginfailed"] = "Matric Number or Password Mismatch. Please try again.";
                header("location:login.php");
            }
        }else{
            $sql1 = "select * from users where matric = '$matric' || email = '$email' || phone = '$phone'";
            $res = mysqli_query($con, $sql1);
            if (mysqli_num_rows($res) == 1){
                $_SESSION["row"] = mysqli_fetch_assoc($res);
                if ($matric == $_SESSION["row"]["matric"]){
                    $_SESSION["matricexists"] = "This user already exists.";
                } else if ($email == $_SESSION["row"]["email"]){
                    $_SESSION["emailexists"] = "This email adress is already in use.";
                }else{
                    $_SESSION["phonexists"] = "This phone number is already in use.";
                }
                header("location:signup.php");
            } else {
                $sql2 = "insert into users (matric, firstname, lastname, email, phone, password, status, hostel) values ('$matric', '$firstname', '$lastname', '$email', '$phone', '$password', '$status', '$hostel')";
                if (mysqli_query($con, $sql2)){ 
                    $_SESSION["regsuccess"] = "Registration Successful. You can now login.";
                    header("location:login.php");
                } else {
                    $_SESSION["regfailed"] = "An Error occurred. Please enter details again.";
                    header("location:signup.php");
                }
            }
        }
    }  
?>