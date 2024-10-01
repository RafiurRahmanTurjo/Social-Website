<?php
include 'save_comment.php';
include 'like.php';

$commentObj = new comment();
$likeManager = new Like();

$db = new show();
$conn = $db->OpenCon();
$posts = $db->getPosts($conn);

$sessionUsername = $_SESSION['username'];

foreach ($posts as $post) {
    $username = $post['username'];
    $postContent = $post['post'];
    $postId = $post['post_id'];

    include'../view/post.php';

    $comments = $commentObj->getComment($conn, $postId);

    foreach ($comments as $comment) {
        $commentUsername = $comment['username'];
        $commentContent = $comment['comment'];
        $commentId = $comment['comment_id'];
        $postId = $comment['post_id'];

        include "../view/comment.php";
    }

    echo "</div>";
}
?>
<script src="js/like.js" ></script>

