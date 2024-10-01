<?php
include '../model/db.php';
$username = $password = $email = $phone = $gender = $birthday = "";
$nameError = $passError = $emailError = $phoneError = $genderError = $birthdayError = "";

if (isset($_POST['Submit'])) {
    if (empty($_POST["username"])) {
        $nameError = "Username is required";
    } elseif (strlen($_POST["username"]) < 4) {
        $nameError = "Username must be at least 4 characters";
    } else {
        $username = $_POST['username'];

        $db = new model();
        $conn = $db->OpenCon();

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $exists = $db->checkUsername($conn, $username);
        
        if ($exists) {
            $nameError = "Username already exists";
        }
    }

    if (empty($_POST["password"])) {
        $passError = "Password is required";
    } elseif (strlen($_POST['password']) < 8) {
        $passError = "Password must be at least 8 characters";
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } elseif (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $_POST["email"])) {
        $emailError = "Invalid email format";
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST["phone"])) {
        $phoneError = "Phone is required";
    } else {
        $phone = $_POST['phone'];
    }

    if (empty($_POST["gender"])) {
        $genderError = "Gender is required";
    } else {
        $gender = $_POST['gender'];
    }

    if (empty($_POST["birthday"])) {
        $birthdayError = "Birthday is required";
    } elseif ($_POST["birthday"] > date("Y-m-d")) {
        $birthdayError = "Birthday cannot be a future date";
    } else {
        $birthday = $_POST['birthday'];
    }

    if (empty($nameError) && empty($passError) && empty($emailError) && empty($phoneError) && empty($genderError) && empty($birthdayError)) {
        $db = new model();
        $conn = $db->OpenCon();
        $result = $db->AddUser($conn, "data", $_POST["username"], $_POST["password"], $_POST["email"], $_POST["phone"], $_POST["gender"], $_POST["birthday"]);
        if ($result === TRUE) {
            echo "<br>";
            echo "Account Successfully Created <br>";
            echo "<br>";
            echo "Redirecting to login in 3, 2, 1....";
            echo "<script>setTimeout(function(){ window.location.href = '../view/login.php'; }, 3000);</script>";
        } else {
            echo "Error Occurred: " . $conn->error;
        }
    } else {
        echo "Invalid Information <br>";
    }
}
if (isset($_POST['redirect_login'])) {
    header("Location: ../view/login.php");
    exit();
}
?>
