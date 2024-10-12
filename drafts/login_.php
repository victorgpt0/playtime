<?php
require 'load.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    //$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // You can store user info in session for further access
            session_start();
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            // Redirect or load user dashboard
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User does not exist!";
    }
}
