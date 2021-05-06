<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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