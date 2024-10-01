<?php
include '../controller/loginController.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    header("Location: welcome.php");
    exit;
}
?>
<html>
<head>
    <title>Login</title>
    
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
<div class="login-container">
    <h1><center>Login Form</center></h1>
    <form method="POST" action="" enctype="multipart/form-data" id="loginForm">
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
        <div class="input-group">
            <input type="text" name="username" id="username" placeholder="Enter your pagename"> <?php echo $nameError; ?></span>
        </div>
        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Enter your password"> <?php echo $passError; ?></span>
        </div>
        <div class="submit-group">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
    <div class="signup-link">
        <p>Don't have an page? <a href="registration.php">Sign Up</a></p>
    </div>
</div>
<script src="../js/loginvalid.js"></script>
</body>
</html>
