<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

include '../controller/loginController.php';
include '../controller/addPost.php';

$username = $_SESSION['username'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/userDetails.js"></script>
</head>
<body>
    <header>
        <h1>Login Successful</h1>
        <link rel="stylesheet" href="../styles/welcome.css">
        <?php 
            echo "<h1>Welcome, $username</h1>"; 
        ?> 
        <form id="fetchUserForm" action="../model/search.php" method="GET">
            <input type="text" id="search_username" name="username" placeholder="Search User">
            <button type="submit">Search</button>
        </form>
        <form id="myprofile" action="../view/profile.php?username=<?php echo $_SESSION['username']; ?>" method="POST">
            <button type="submit">My Page</button>
        </form>
        <form id="logoutForm" action="../controller/logout.php" method="POST">
            <button type="submit">Logout</button>
        </form>

    </header>

    <main>
        <section id="userDetailsSection">
            <div id="userDetails"></div>
        </section>
        <section id="postSection">
            <!-- Your HTML code -->
            <form id="postForm" method="POST" action="">
                <textarea id="post" name="post" placeholder="What's on your mind?"></textarea>
                <button id="post_button" type="submit">Post</button>
            </form>
        </section>
        <section id="displayPosts">
            <?php   
            include '../controller/showPost.php';
            ?>
        </section>
    </main>
</body>
</html>
