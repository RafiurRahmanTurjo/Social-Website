<?php
class show1 {
    function OpenCon() {
        $conn = new mysqli("localhost", "root", "", "user");
        return $conn;
    }

    public function pinPosts($conn, $username) {
        $sql = "SELECT * FROM pin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die('Error preparing SQL statement: ' . $conn->error);
        }
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die('Error executing SQL statement: ' . $stmt->error);
        }
        $result = $stmt->get_result();
        $pinPosts = array();
        while ($row = $result->fetch_assoc()) {
            $pinPosts[] = $row;
        }
        return $pinPosts;
    }
    

    function getPosts($conn, $username) {
        $sql = "SELECT * FROM post WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $posts = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }

        return $posts;
    }

    function getPp($conn, $username) {
        $sql = "SELECT profile_picture FROM data WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    function getComment($conn, $postId) {
        $sql = "SELECT * FROM comment WHERE post_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $comments = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $comments[] = $row;
            }
        }
    
        return $comments;
    }
}
?>
