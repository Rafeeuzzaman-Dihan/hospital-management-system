<?php
session_start();

include "../includes/navbar.php";
include "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check user in DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // For now password is plain text
        if ($user['password'] === $password) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header("Location: ../admin/dashboard.php");
                    exit;
                case 'doctor':
                    header("Location: ../doctor/dashboard.php");
                    exit;
                case 'user':
                    header("Location: ../user/dashboard.php");
                    exit;
                case 'lab':
                    header("Location: ../lab/dashboard.php");
                    exit;
            }
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/login.css">

<div class="login-container">
    <h2>Login</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="links">
            <a href="forgot-password.php">Forgot Password?</a>
            <span>|</span>
            <a href="register.php">Register Now</a>
        </div>
    </form>
</div>
