<?php
class Like {
    private $conn;

    public function OpenCon() {
        $this->conn = new mysqli("localhost", "root", "", "user");
        return $this->conn;
    }

    public function likePost($conn, $postId, $username) {
        $sql = "INSERT INTO likes (post_id, username) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        return $stmt->execute();
    }

    public function unlikePost($conn, $postId, $username) {
        $sql = "DELETE FROM likes WHERE post_id = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        return $stmt->execute();
    }

    public function isPostLiked($conn, $postId, $username) {
        $sql = "SELECT COUNT(*) as liked FROM likes WHERE post_id = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['liked'] > 0;
    }
}
?>
