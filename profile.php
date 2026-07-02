<?php
// profile.php
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pdo = getDBConnection();
$profileId = $_GET['id'] ?? $_SESSION['user_id'];

// INTENTIONAL VULNERABILITY // EDUCATIONAL PURPOSE ONLY
// Vulnerability: Insecure Direct Object Reference (IDOR)
// Why it's vulnerable: The code fetches user data based entirely on the URL parameter '?id='
// It NEVER checks if the requested $profileId actually belongs to the logged-in user.

$stmt = $pdo->prepare("SELECT id, username, role, department, salary FROM users WHERE id = :id");
$stmt->execute(['id' => $profileId]);
$profileUser = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profileUser) {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - VulnWeb</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise</h1>
        <nav><a href="dashboard.php">Dashboard</a> <a href="logout.php">Logout</a></nav>
    </header>

    <div class="container">
        <h2>Employee Profile: <?php echo htmlspecialchars($profileUser['username']); ?></h2>
        
        <table>
            <tr>
                <th>Employee ID</th>
                <td><?php echo (int)$profileUser['id']; ?></td>
            </tr>
            <tr>
                <th>Department</th>
                <td><?php echo htmlspecialchars($profileUser['department']); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php echo htmlspecialchars($profileUser['role']); ?></td>
            </tr>
            <tr>
                <th>Salary (Confidential)</th>
                <td>$<?php echo number_format($profileUser['salary']); ?></td>
            </tr>
        </table>
        
        <p style="margin-top:20px; font-size:12px; color:#666;">
            URL Parameter ID: <code><?php echo htmlspecialchars($profileId); ?></code>
        </p>
    </div>
</body>
</html>
