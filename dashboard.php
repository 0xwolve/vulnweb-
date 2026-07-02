<?php
// dashboard.php
require_once 'includes/db.php';

// Enforce authentication
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$username = htmlspecialchars($_SESSION['username']);
$role = htmlspecialchars($_SESSION['role']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - VulnWeb</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise</h1>
        <nav>
            <a href="search.php">Directory Search</a>
            <a href="profile.php?id=<?php echo $userId; ?>">My Profile</a>
            <a href="logout.php" id="logout-link">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>Dashboard</h2>
        <p>Welcome back, <strong><?php echo $username; ?></strong>.</p>
        
        <table class="data-table">
            <tr>
                <th>System Status</th>
                <td>All Systems Operational</td>
            </tr>
            <tr>
                <th>Your Access Level</th>
                <td><?php echo $role; ?></td>
            </tr>
            <tr>
                <th>Corporate Memos</th>
                <td>No new memos today.</td>
            </tr>
        </table>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>
