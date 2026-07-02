<?php
// index.php
require_once 'includes/config.php';

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VulnWeb - Corporate Portal</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise Portal</h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>

    <div class="container">
        <h2>Welcome to the Employee Portal</h2>
        <p>Please log in to access your employee dashboard, view your department details, and search the corporate directory.</p>
        <p><em>Notice: Unauthorized access to this system is strictly prohibited.</em></p>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>
