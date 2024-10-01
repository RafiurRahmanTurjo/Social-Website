<?php
include"../model/comment.php";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_comment"])) {

    $commentId = $_POST["comment_id"];


    $delete = new comment();
    $conn = $delete->OpenCon();
    
    $delete->delete($conn, $commentId);

    echo "Comment deleted successfully.";
    echo "  Redirecting to Home in 3, 2, 1....";
    echo "<script>setTimeout(function(){ window.location.href = '../view/login.php'; }, 3000);</script>";
    exit;
}
?>
