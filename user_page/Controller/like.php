<?php
include "../model/like.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["like_post"])) {
    $postId = $_POST['post_id'];
    $username = $_SESSION['username'];

    $likeManager = new Like();
    $conn = $likeManager->OpenCon(); 

    if ($likeManager->isPostLiked($conn, $postId, $username)) {
        $likeManager->unlikePost($conn, $postId, $username);
    } else {
        $likeManager->likePost($conn, $postId, $username);
    }
    header("Location: ../view/login.php"); 
    exit();
} else {
    echo "";
}
?>
