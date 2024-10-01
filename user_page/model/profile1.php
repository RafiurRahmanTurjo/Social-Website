<?php
$username = isset($_GET['username']) ? $_GET['username'] : ''; 
$sessionUsername = $_SESSION['username'];

$db = new show1();
$conn = $db->OpenCon();
$user_pic = $db->getPp($conn, $username);
include 'pin.php';

$pinManager = new pin();
$profile_picture = null; 

if ($user_pic !== null && isset($user_pic['profile_picture'])) {
    $profile_picture = $user_pic['profile_picture'];
}
$pinPosts = $db->pinPosts($conn, $username);
$posts = $db->getPosts($conn, $username);

$query_followers = "SELECT followers FROM follow WHERE username = '$username'";
$result_followers = mysqli_query($conn, $query_followers);

if ($result_followers !== false) {
    $follower_count = mysqli_num_rows($result_followers);
} else {
    $follower_count = 0;
}

$query_following = "SELECT following FROM followers WHERE follower_username = '$username'";
$result_following = mysqli_query($conn, $query_following);

if ($result_following !== false) {
    $following_count = mysqli_num_rows($result_following);
} else {
    $following_count = 0; 
}
?>