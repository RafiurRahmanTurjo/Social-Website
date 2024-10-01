<?php
include"../model/comment.php";
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["BTN_REPORT"])) {

    $commentId = $_POST["comment_id"];
    $commentContent = $_POST["comment"];
    $reporterUsername = $_SESSION['username'];
    $postId = $_POST["post_id"];

    $report = new comment();
    $conn = $report->OpenCon();
    
    $report->report($conn, $postId,$commentId, $commentContent,$reporterUsername);

    echo "Comment reported successfully.";
    echo "  Redirecting to Home in 3, 2, 1.... ";
    echo"<br>";
    echo "<script>setTimeout(function(){ window.location.href = '../view/login.php'; }, 3000);</script>";
    exit;
}
?>
