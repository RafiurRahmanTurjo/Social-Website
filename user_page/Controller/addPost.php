<?php
include '../model/post.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$post = $haserror = "";
$nameError = $postError = "";

if(isset($_POST['post'])) {
    $table = "post";

    if(empty($_POST["post"])) {
        $haserror = 1;
        $postError = "Enter Post";
    } else {
        $post = $_POST['post'];
    }

    if($haserror != 1) {
        $db = new show();
        $conn = $db->OpenCon();
        $result = $db->addPost($conn, $table, $username, $post);

        if($result) {
            echo "Successfully Posted";
        } else {
            echo "Error Occurred: " . $conn->error;
        }
    } else {
        echo "Failed";
    }
}

if(isset($_POST['redirect_login'])) {
    header("Location: ../view/login.php");
    exit();
}
?>
