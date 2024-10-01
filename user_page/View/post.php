<html>
<body>
<div class='post'>
    <br>
    <h2><a href='profile.php?username=<?php echo $username; ?>'><?php echo $username; ?></a></h2>
    <?php if ($sessionUsername === $username): ?>
        <form class='Delete-Button' method='POST' action='../Controller/deletePost.php'>
            <input type='hidden' name='post_id' value='<?php echo $postId; ?>'>
            <button class='delete-button' type='submit' name='delete_post'>Delete</button>
        </form>
        <form method='POST' action=''>
            <input type='hidden' name='post_id' value='<?php echo $postId; ?>'> 
        </form>
    <?php endif; ?>
    <br>
    <p><?php echo $postContent; ?></p>
    <br>
    <br>
    <form class='likeForm' method='POST' action='../Controller/like.php'>
        <input type='hidden' name='username' value='<?php echo $username; ?>'>
        <input type='hidden' name='post_id' value='<?php echo $postId; ?>'>
        <button class='like_button' type='submit' name='like_post'>
            <?php if ($likeManager->isPostLiked($conn, $postId, $sessionUsername)): ?>
                Liked
            <?php else: ?>
                Like
            <?php endif; ?>
        </button>
    </form>
    <form class='commentForm' method='POST' action=''>
        <input type='hidden' name='post_id' value='<?php echo $postId; ?>'>
        <textarea class='comment' name='comment' placeholder='Write a comment'></textarea>
        <button id='like_button' class='post_comment_button' type='submit'>Post Comment</button>
        <br>
    </form>

</body>
</html>