<?php include "../includes/navbar.php"; ?>

<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/register.css">

<div class="register-container">
    <h2>Register</h2>
    <form id="registerForm" action="#" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" placeholder="Enter first name" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" placeholder="Enter last name" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
        </div>

        <button type="submit" class="btn">Register</button>
    </form>
</div>

<!-- Validation Script -->
<script>
    document.getElementById("registerForm").addEventListener("submit", function(e) {
        let first = document.getElementById("firstname").value.trim();
        let last = document.getElementById("lastname").value.trim();
        let user = document.getElementById("username").value.trim();
        let pass = document.getElementById("password").value;
        let confirm = document.getElementById("confirm_password").value;

        // Basic validations
        if (first.length < 2) {
            alert("First name must be at least 2 characters.");
            e.preventDefault();
            return;
        }
        if (last.length < 2) {
            alert("Last name must be at least 2 characters.");
            e.preventDefault();
            return;
        }
        if (!/^[a-zA-Z0-9]+$/.test(user)) {
            alert("Username must contain only letters and numbers.");
            e.preventDefault();
            return;
        }
        if (pass !== confirm) {
            alert("Passwords do not match.");
            e.preventDefault();
            return;
        }
    });
</script>
