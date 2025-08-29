<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - City Hospital</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- Navbar -->
<header class="navbar">
    <div class="logo">
        <h2>City Hospital</h2>
    </div>
    <nav class="nav-links">
        <a href="../index.php">Home</a>
        <a href="../index.php#services">Services</a>
        <a href="../index.php#doctors">Doctors</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<!-- Register Form -->
<section class="form-section">
    <div class="form-container">
        <h2>Create an Account</h2>
        <form action="" method="post">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</section>

</body>
</html>
