<?php
include"../model/post.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_post"])) {

    $postId = $_POST["post_id"];


    $delete = new show();
    $conn = $delete->OpenCon();
    
    $delete->delete($conn, $postId);

    echo "Post deleted successfully.";
    echo "  Redirecting to Home in 3, 2, 1....";
    echo "<script>setTimeout(function(){ window.location.href = '../view/login.php'; }, 3000);</script>";
    
    exit;
}
?>
