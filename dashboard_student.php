<?php
    session_start();
    if (isset($_POST["logout"])){
        unset($_SESSION["userDetails"]);
        session_destroy();
    }
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    require("dbconnect.php");
    $sql1 = "select id, itemname, description, image  from donation";
    $res = mysqli_query($con, $sql1);
    $arr = [];
    if (mysqli_num_rows($res)){
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            array_push($arr, $row);
        }
        mysqli_free_result($res);
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
        <div class="greeting">
            <?php echo "Hello, " .$_SESSION["userDetails"]["firstname"]." "; ?>
        </div>
        <?php
            foreach ($arr as $val){
        ?>
        <div class="item">
            <?php echo $val["itemname"]; ?>
        </div>
        <div class="descrip">
            <?php echo $val["description"];?>
        </div>
        <div class="image-file">
            <img src="images/<?php echo $val["image"];?>" id = "imagefile" alt="" height="75" width = "75">
        </div>
        <form action="request.php" method="POST">
            <input type="submit" name="<?php echo $val["id"];?>" value="REQUEST">
        </form>
        <?php
            }
            include("functions.php");
            if (isset($_SESSION["reqexists"])){ 
                $msg = mysqli_real_escape_string($con, $_SESSION["reqexists"]);
                dispJs($msg);
                unset($_SESSION["reqexists"]);
            }
            if (isset($_SESSION["requestsuccess"])){
                $msg = mysqli_real_escape_string($con, $_SESSION["requestsuccess"]);
                dispJs($msg);
                unset($_SESSION["requestsuccess"]);
            }
        ?>
        <form action="dashboard_student.php" method="POST">
            <input type="submit" name="logout" value="Logout">
        </form>
    </body>
</html>