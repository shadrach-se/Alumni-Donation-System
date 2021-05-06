<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <form action="auth.php" method="post">
        <label for="matric">Matric No:</label>
        <div class="matric">
            <input type="text" name="matric" required>
        </div>
        <label for="firstname">First Name:</label>
        <div class="firstname">
            <input type="text" name="firstname" required>
        </div>
        <label for="lastname">Last Name:</label>
        <div class="lastname">
            <input type="text" name="lastname" required>
        </div>
        <label for="email">Email:</label>
        <div class="email">
            <input type="email" name="email" required>
        </div>
        <label for="phone">Phone Number:</label>
        <div class="phone">
            <input type="phone" name="phone" required>
        </div>
        <label for="password">Password:</label>
        <div class="password">
            <input type="password" name="password" required>
        </div>
        <label>Select your status:</label>
        <div class="status">
            <input type="radio" name="status" value="alumni"><label for="alumni">Alumni</label>
            <input type="radio" name="status" value="student"><label for="student">Student</label>
        </div>
        <label>Hall Of Residence </label>
        <div class="hostel">
            <select name = "hostel">
                <option value="biobaku">Biobaku Hall</option>
                <option value="jaja">Jaja Hall</option>
                <option value="mariere">Mariere Hall</option>
                <option value="eni-njoku">Eni-Njoku Hall</option>
                <option value="sodeinde">Sodeinde Hall</option>
                <option value="kofo">Kofo Hall</option>
                <option value="amina">Amina Hall</option>
                <option value="moremi">Moremi Hall</option>
                <option value="mth">MTH Hall</option>
                <option value="makama">Makama Hall</option>
                <option value="fagunwa">Fagunwa Hall</option>
            </select>
        </div>
        <input type="hidden" name="action" value="register">
        <p>Have an account? <a href="login.php">Sign in</a></p>
        <div class="submit">
            <input type="submit" value="Submit">
        </div>
    </form>
    

    <?php
        include("functions.php");
        if (isset($_SESSION["regfailed"])){
            $msg = $_SESSION["regfailed"];
            dispJs($msg);
            unset($_SESSION["regfailed"]);
        } else if (isset($_SESSION["matricexists"])){
            $msg = $_SESSION["matricexists"];
            dispJs($msg);
            unset($_SESSION["matricexists"]);
        } else if (isset($_SESSION["emailexists"])){
            $msg = $_SESSION["emailexists"];
            dispJs($msg);
            unset($_SESSION["emailexists"]);
        } else if (isset($_SESSION["phoneexists"])){
            $msg = $_SESSION["phoneexists"];
            dispJs($msg);
            unset($_SESSION["phoneexists"]);
        }
        
    ?>
</body>
</html>