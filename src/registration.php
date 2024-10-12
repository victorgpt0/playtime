<?php
require 'load.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roleId = $_POST['roleId']; // Role dropdown
    $genderId = $_POST['genderId']; // Gender dropdown

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email or username already exists
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :email OR username = :username");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Email or Username already exists!";
    } else {
        // Insert the user into the database
        $stmt = $conn->prepare("INSERT INTO tbl_users (fullname, email, username, password, roleId, genderId) 
            VALUES (:fullname, :email, :username, :password, :roleId, :genderId)");
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':roleId', $roleId);
        $stmt->bindParam(':genderId', $genderId);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: Could not register user.";
        }
    }
}

