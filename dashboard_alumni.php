<?php
    session_start();
    if (isset($_POST["logout"])){
        unset($_SESSION["userDetails"]);
        session_destroy();
    }
    if (!isset($_SESSION["userDetails"])){
        header("location:login.php");
    }
    if (isset($_POST["upload"])){
        require("dbconnect.php");
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "images/".$filename;
        $userid = $_SESSION["userDetails"]["id"];
        $itemname = mysqli_real_escape_string($con, $_POST["itemname"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]);
        $sql1 = "select * from donation where userid = '$userid' && itemname = '$itemname' && description = '$description' && image = '$filename'";
        $res1 = mysqli_query($con, $sql1);
        if (mysqli_num_rows($res1) == 1){
            $msg = "You can only upload this item once. Please upload another item.";
        } else {
            $sql2 = "insert into donation (userid, itemname, description, image) values ('$userid', '$itemname', '$description', '$filename')";
            mysqli_query($con, $sql2);
            if (move_uploaded_file($tempname, $folder))  {
                $msg = "Item uploaded successfully";
            }else{
                $msg = "Failed to upload image";
            }
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
        <div class="greeting">
            <?php echo "Hello, " .$_SESSION["userDetails"]["firstname"]." "; ?>
        </div>
        <form action="dashboard_alumni.php" method="POST" enctype="multipart/form-data">
            <label for="itemname">Item Name: </label>
            <div class="itemname">
                <input type="text" name="itemname" required>
            </div>
            <label for="description">Description: </label>
            <div class="description">
                <input type="text" name="description" required>
            </div>
            <label for="image">Image File: </label><input type="file" name="image" required>
            <div class="upload">
                <input type="submit" name = "upload" value="Upload">
            </div>
            <?php 
                include("functions.php");
                if (isset($msg)){
                    dispJs($msg); 
                }
            ?>
        </form>
        <div class="requests">
            <form action="dashboard_alumni_requests.php" method="POST">
                    <input type="submit" value="See all requests">
            </form>
        </div>
        <div class="logout">
            <form action="dashboard_alumni.php" method="POST">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
    </body>
</html>