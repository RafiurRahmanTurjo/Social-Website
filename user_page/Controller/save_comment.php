<?php
include '../model/comment.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $commentObj = new comment();
    $conn = $commentObj->OpenCon();
    
    $commentObj->insertComment($conn, $post_id,$username, $comment);
    header("Location: ../view/login.php"); 
    exit();
}
?>
