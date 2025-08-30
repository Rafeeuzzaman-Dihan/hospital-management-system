<?php include "../includes/navbar.php"; ?>

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
