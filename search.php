<?php
// search.php
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$searchQuery = $_GET['q'] ?? '';
$results = [];

if ($searchQuery) {
    $pdo = getDBConnection();
    // Safe from SQLi via prepared statements
    $stmt = $pdo->prepare("SELECT username, department FROM users WHERE username LIKE :q OR department LIKE :q");
    $searchTerm = "%" . $searchQuery . "%";
    $stmt->execute(['q' => $searchTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory Search - VulnWeb</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise</h1>
        <nav><a href="dashboard.php">Dashboard</a> <a href="logout.php">Logout</a></nav>
    </header>

    <div class="container">
        <h2>Corporate Directory Search</h2>
        
        <form method="GET" action="search.php">
            <input type="text" name="q" placeholder="Search by name or department..." value="<?php 
                // INTENTIONAL VULNERABILITY // EDUCATIONAL PURPOSE ONLY
                // Vulnerability: Reflected Cross-Site Scripting (XSS) inside an attribute.
                echo $searchQuery; 
            ?>">
            <input type="submit" value="Search">
        </form>

        <?php if ($searchQuery): ?>
            <div class="search-results">
                <h3>Results for: <?php echo $searchQuery; ?></h3>
                
                <?php if (count($results) > 0): ?>
                    <ul>
                        <?php foreach ($results as $row): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($row['username']); ?></strong> 
                                (<?php echo htmlspecialchars($row['department']); ?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No employees found.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
