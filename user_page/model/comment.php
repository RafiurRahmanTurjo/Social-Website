<?php 
class comment{
    function OpenCon() {
        $conn = new mysqli("localhost", "root", "", "user");
        return $conn;
    }
    function getComment($conn, $post_id) {
        $sql = "SELECT * FROM comment WHERE post_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $post_id);
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
    function insertComment($conn, $post_id,$username, $comment) {
        $sql = "INSERT INTO comment (post_id,username, comment) VALUES (?,?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $post_id,$username, $comment);
        $stmt->execute();
    }

    function report($conn, $post_id, $username, $comment, $comment_id) {
        $sql = "INSERT INTO report (post_id, comment_id, comment, username) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $post_id, $comment_id, $comment, $username);
        $stmt->execute();
        $stmt->close();
    }

    function delete($conn, $comment_id) {
        $sql = "DELETE FROM `comment` WHERE comment_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$comment_id);
        $stmt->execute();
        $stmt->close();
    }
}
?>