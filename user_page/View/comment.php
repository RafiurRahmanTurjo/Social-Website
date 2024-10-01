<html>
<body>
<div class='comment'>
    <br>
    <p><a href='../view/profile.php?username=<?php echo $commentUsername; ?>'><?php echo $commentUsername; ?></a>: <?php echo $commentContent; ?></p>
    <br>
    <form class='reportForm' method='POST' action='../Controller/reportComment.php'>
        <input type='hidden' name='comment_id' value='<?php echo $commentId; ?>'>
        <input type='hidden' name='comment' value='<?php echo $commentContent; ?>'>
        <input type='hidden' name='post_id' value='<?php echo $postId; ?>'>
        <button class='report-button' type='submit' name='BTN_REPORT'>Report</button>
    </form>
    <?php if ($sessionUsername === $commentUsername || $sessionUsername === $username): ?>
        <form class='Delete-Button' method='POST' action='../Controller/deleteComment.php'>
            <input type='hidden' name='comment_id' value='<?php echo $commentId; ?>'>
            <button class='delete-button' type='submit' name='delete_comment'>Delete</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>