<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="container">
            <div class="nav-wrapper">
                <div class="left-side">
                    <div class="nav-link-wrapper">
                        <a href="signup.php">Home</a>
                    </div>
                    <div class="nav-link-wrapper active-nav-link">
                        <a href="login.php">LOGIN</a>
                    </div>

                    <div class="right-side">
                        <div class="brand">
                            <div>Alumni Donation</div>
                         </div>
                     </div> 
                </div>
            </div>

    <div class="details">
        <form action="auth.php" method="post">
            <label for="matric">Matric No: </label>
            <div class="matric">
                <input type="text" name="matric" required>
            </div>
            <label for="password">Password: </label>
            <div class="password">
                <input type="password" name="password" required>
            </div>
            <input type="hidden" name="action" value="login">
            <p>Don't have an account? <a href="signup.php">Create one!</a></p>
            <div class="signin">
                <input type="submit" value="Sign in">
            </div>
        </form>
    </div>
    <?php
        include("functions.php");
        if (isset($_SESSION["loginfailed"])){
            $msg = $_SESSION["loginfailed"];
            dispJs($msg);
            unset($_SESSION["loginfailed"]);
        } 
        if (isset($_SESSION["regsuccess"])){
            $msg = $_SESSION["regsuccess"];
            disJs($msg);
            unset($_SESSION["regsuccess"]);
        }
    ?>
</body>
</html>