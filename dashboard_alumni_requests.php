<?php
    session_start();
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    require("dbconnect.php");
    $userid = $_SESSION["userDetails"]["id"];
    $sql1 = "select id, itemname from donation where userid = '$userid' && status = '0'";
    $res1 = mysqli_query($con, $sql1);
    $donIdArray = [];
    $donitemArray = [];
    while ($rows = mysqli_fetch_array($res1, MYSQLI_NUM)){
        array_push($donIdArray, $rows[0]);
        $donitemArray["$rows[0]"] = $rows[1];
    }
    mysqli_free_result($res1);
    $donuserIdArray = [];
    foreach ($donIdArray as $val){
        $sql2 = "select userid from request where donationid = '$val'";
        $res2 = mysqli_query($con, $sql2);
        if (mysqli_num_rows($res2) > 0){
            while ($row = mysqli_fetch_array($res2, MYSQLI_NUM)){
                if (isset($donuserIdArray["$val"])){
                    array_push($donuserIdArray["$val"], $row[0]);
                } else{
                    $donuserIdArray["$val"] = array($row[0]);
                }
            }
            mysqli_free_result($res2);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="home-bar">
        <a href="dashboard_alumni.php">Home</a>
    </div>
    <?php
        foreach ($donuserIdArray as $key => $value){
            foreach ($value as $vals){
                $sql3 = "select firstname, lastname, matric from users where id = '$vals'";
                $res3 = mysqli_query($con, $sql3);
                while ($ro = mysqli_fetch_array($res3, MYSQLI_NUM)){
    ?>
    <div class="container">
        <?php echo $donitemArray["$key"]; ?>:
        <?php echo $ro[0]." ".$ro[1]." ".$ro[2]; } ?>
        <a href= <?="grant.php?donationId=".$key."&userId=".$vals; ?>>Grant</a>
    </div>
        <br>
    <?php
                }
            }
    include("functions.php");
    if (isset($_SESSION["grantfail"])){ 
            $msg = mysqli_real_escape_string($con, $_SESSION["grantfail"]);
            dispJs($msg);
            unset($_SESSION["grantfail"]);
    }
    ?>
</body>
</html>