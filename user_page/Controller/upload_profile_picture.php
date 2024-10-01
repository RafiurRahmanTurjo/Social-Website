<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if ($_FILES["profile_picture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $username = $_SESSION['username'];
                $profile_picture_path = $target_file;

                 $conn = new mysqli("localhost", "root", "", "user");

                 if ($conn->connect_error) {
                     die("Connection failed: " . $conn->connect_error);
                 }
 
                 $sql = "UPDATE data SET profile_picture = ? WHERE username = ?";
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("ss", $profile_picture_path, $username);
                 
                 if ($stmt->execute()) {
                     echo "Profile picture updated successfully.";
                 } else {
                     echo "Error updating profile picture: " . $conn->error;
                 }
 
                 $conn->close();

                echo "The file ". htmlspecialchars( basename( $_FILES["profile_picture"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
