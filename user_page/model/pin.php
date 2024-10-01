<?php
class pin {
    private $conn;

    public function OpenCon() {
        $this->conn = new mysqli("localhost", "root", "", "user");
        return $this->conn;
    }

    public function pinned($conn, $postId, $username, $pinPost) {
        $sql = "INSERT INTO pin (post_id, username, post) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $postId, $username, $pinPost);
        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }

    public function unpinPost($conn, $postId, $username) {
        $sql = "DELETE FROM pin WHERE post_id = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    public function pinPost($conn, $postId, $username) {
        $sql = "SELECT COUNT(*) as Pinned FROM pin WHERE post_id = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $postId, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && $row['Pinned'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
