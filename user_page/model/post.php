<?php
class show{
    function OpenCon() {
        $conn = new mysqli("localhost", "root", "", "user");
        return $conn;
    }
    function addPost($conn, $table, $username, $post) {
        $sql = "INSERT INTO $table (username, post) VALUES ('$username', '$post')";
        if ($conn->query($sql) === TRUE) {
            return "Successfully Posted";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    function getPosts($conn) {
        $sql = "SELECT * FROM post";
        $result = $conn->query($sql);
    
        $posts = array();
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
    
        return $posts;
    }
    function delete($conn, $post_id) {
        $sql = "DELETE FROM `post` WHERE post_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$post_id);
        $stmt->execute();
        $stmt->close();
    }

    function update($conn, $post_id,$post) {
        $sql = "UPDATE `post` username WHERE post_id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$post_id);
        $stmt->execute();
        $stmt->close();
    }
}

?>
