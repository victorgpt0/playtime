<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $user_group = (int) $_POST['user_group'];

    $stmt = $conn->prepare("SELECT id, password, user_group FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_group'] = $user['user_group'];

            if ($user['user_group'] == 1) {
                header("");
                exit();
            } elseif ($user['user_group'] == 2) {
                header("");
                exit();
            } else {
                echo "Invalid user group.";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username or user group.";
    }

    $stmt->close();
}

$conn->close();
?>
