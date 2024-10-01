<?php
include '../model/profile.php';
include '../Controller/upload_profile_picture.php';
include '../model/profile1.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'s Profile</title>
    <link rel="stylesheet" href="styles/profile.css">
</head>
<body>
<link rel="stylesheet" href="../styles/profile.css">
    <header>
    <form id="fetchUserForm" action="../model/search.php" method="GET">
            <input type="text" id="search_username" name="username" placeholder="Search User">
            <button type="submit">Search</button>
        </form>
        <form id="logoutForm" action="../controller/logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>
    <?php
        if ($sessionUsername === $username) {
        ?>
        <div class="profile-info">
            <form action="../Controller/upload_profile_picture.php" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_picture" accept="image/*">
                <input type="submit" value="Upload Profile Picture" name="submit">
            </form>
        </div>
        <?php
        }
        ?>
</form>
<img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="200" height="250">
            <div>
             
                <h2><?php echo $username; ?></h2>
               
            </div>
        </div>
        <div class="profile-stats">
            <div>
                <strong><?php echo $follower_count; ?></strong>
                <span>Followers</span>
            </div>
            <div>
                <strong><?php echo $following_count; ?></strong>
                <span>Following</span>
            </div>
        </div>
        <nav>
            <a href="welcome.php">Home</a>
        </nav>
    </header>

    <main>
    <section class="user-tweets">
    <?php foreach ($pinPosts as $pinPostItem) { ?>
        <div class="tweet">
            <h2><?php echo $username; ?></h2>
            <br>
            <p><?php echo $pinPostItem['post']; ?><br></p>
            <br>
            <div class="tweet-actions">
                <button>Like</button>
                <br>
                <?php 
                $pinPostId = $pinPostItem['post_id'];
                ?>
                <form class='pinForm' method='POST' action='../Controller/pin.php'>
                    <br>
                    <input type='hidden' name='username' value='<?php echo $username; ?>'>
                    <input type='hidden' name='post_id' value='<?php echo $pinPostItem['post_id']; ?>'>
                    <input type='hidden' name='post' value='<?php echo $pinPostItem['post']; ?>'>
                    <button class='pin_button' type='submit' name='pin_post'>
                        <?php if ($pinManager->pinPost($conn, $pinPostId, $username)): ?>
                            Pinned
                        <?php else: ?>
                            Pin
                        <?php endif; ?>
                    </button>
                </form>
                </div> 
                       <?php 
               
                $postId = $pinPostItem['post_id'];
                $commentObj = new show1();
                $comments = $commentObj->getComment($conn, $postId);

                foreach ($comments as $comment) {
                    if (isset($comment['post_id'])) {
                        $commentUsername = $comment['username'];
                        $commentContent = $comment['comment'];
                        $commentId = $comment['comment_id'];
                        $postId = $comment['post_id'];

                        include "../view/comment.php";
                    }
                }
                ?>
                    </div>
            </div>
        </div>
    <?php } ?>
</section>
        <section class="user-tweets">
            <?php foreach ($posts as $post) { ?>
                <div class="tweet">
                    <h2><?php echo $username; ?></h2>
                    <br>
                    <p><?php echo $post['post']; ?></p>
                    <br>
                    <div class="tweet-actions">
                        <button>Like</button>
                        <?php 
                        $pinPost = $post['post'];
                        $postId = $post['post_id'];
                    ?>
                    <form class='pinForm' method='POST' action='../Controller/pin.php'>
                        <br>
                        <input type='hidden' name='username' value='<?php echo $username; ?>'>
                        <input type='hidden' name='post_id' value='<?php echo $post['post_id']; ?>'>
                        <input type='hidden' name='post' value='<?php echo $pinPost; ?>'>
                        <button class='pin_button' type='submit' name='pin_post'>
                        <?php if ($pinManager->pinPost($conn, $postId, $username)): ?>
                Pinned
            <?php else: ?>
                Pin
            <?php endif; ?>
                        </button>
                    </form>              

</div> 
                       <?php 
               
                $postId = $post['post_id'];
                $commentObj = new show1();
                $comments = $commentObj->getComment($conn, $postId);

                foreach ($comments as $comment) {
                    if (isset($comment['post_id'])) {
                        $commentUsername = $comment['username'];
                        $commentContent = $comment['comment'];
                        $commentId = $comment['comment_id'];
                        $postId = $comment['post_id'];

                        include "../view/comment.php";
                    }
                }
                ?>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>
</body>
</html>
