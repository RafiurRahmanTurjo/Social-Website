<?php
include "../model/pin.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pin_post"])) {
    $postId = $_POST['post_id'];
    $username = $_SESSION['username'];
    $pinPost = $_POST['post'];

    $pinManager = new pin();
    $conn = $pinManager->OpenCon(); 

    if ($pinManager->pinPost($conn, $postId, $username)) {
        if ($pinManager->unpinPost($conn, $postId, $username)) {
            echo "Successful";
        } else {
            echo "Error unpinning post";
        }
    } else {
        if ($pinManager->pinned($conn, $postId, $username, $pinPost)) {
            echo "Successful";
        } else {
            echo "Error pinning post";
        }
    }
   
    $conn->close();
    header("Location: ../view/profile.php?username=$username");

    exit();
} else {
    echo "";
}
?>
