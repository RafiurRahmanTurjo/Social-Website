<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['username'])) {
    $conn = new mysqli("localhost", "root", "", "user");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_GET['username'];

    $stmt = $conn->prepare("SELECT * FROM data WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
 
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>Name: " . $row['username'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            echo "<p>Phone: " . $row['phone'] . "</p>";
            echo "<br>";
        }
    } else {
        echo "0 results";
    }

    $stmt->close();
    $conn->close();
}
?>
