<!DOCTYPE html>
<?php include '../controller/register.php'; ?>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="../styles/reg.css">
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
    <label for="username">Page name:</label>
    <input type="text" name="username" id="username">
    <div class="error-message"><?php echo $nameError; ?></div>
</div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type='password' name='password' id="password">
                <div class="error-message"><?php echo $passError; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type='email' name='email' id="email">
                <div class="error-message"><?php echo $emailError; ?></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type='tel' name='phone' id="phone">
                <div class="error-message"><?php echo $phoneError; ?></div>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label>
                <div class="error-message"><?php echo $genderError; ?></div>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday">
                <div class="error-message"><?php echo $birthdayError; ?></div>
            </div>
            <div class="form-group">
                <input type='submit' name='Submit' id="Submit">
                <input type='reset' name='reset' id="reset">
            </div>
            <input type="submit" name="redirect_login" value="Go to Login">
        </form>
    </div>
</body>
</html>
