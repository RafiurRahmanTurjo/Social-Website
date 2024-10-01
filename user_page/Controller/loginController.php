<?php
include '../model/db.php';

$username = $password = $email = $haserror = "";
$nameError = $passError = $emailError = "";
$errorMessage = "";

if(isset($_POST['login'])) {
    if(empty($_POST["username"])) {
        $nameError = "Username is empty";
    } else {
        $username = $_POST['username'];
    }

    if(empty($_POST['password'])) {
        $passError = "Password is empty";
    } else {
        $password = $_POST['password'];
    }

    $db = new model();
    $conn = $db->OpenCon();

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "";
    }

    $result = $db->login($conn, "data", $_POST["username"], $_POST["password"]);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $count = mysqli_num_rows($result);  
    

    if($count == 1) {  
            $login=true;
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['username'] = $username;
        header("Location: ../view/welcome.php");
        exit();
    } else {  
        $errorMessage = "Username & Password Invalid";
    }     
}
?>

