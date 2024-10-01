<?php
class model
{
    function OpenCon() {
        $conn = new mysqli("localhost", "root", "", "user");
        return $conn;
    }

    function AddUser($conn, $table, $username, $password, $email, $phone, $gender,$birthday) {
        $sql = "INSERT INTO $table (username, password, email, phone, gender,birthday) VALUES ('$username', '$password', '$email', '$phone', '$gender','$birthday')";
        $result = $conn->query($sql);
        return $result;
    }

    function login($conn, $table, $username, $password) {
        $sql = "select* from data where username = '$username' and password = '$password'";
        $result = $conn->query($sql);
        return $result;
    }

    function checkUsername($conn, $username) {
        $stmt = $conn->prepare("SELECT * FROM data WHERE username = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }

        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }
}
?>
