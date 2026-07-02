<?php
// login.php
require_once 'includes/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $pdo = getDBConnection();

    // INTENTIONAL VULNERABILITY // EDUCATIONAL PURPOSE ONLY
    // Vulnerability: SQL Injection (SQLi)
    // Why it's vulnerable: Direct concatenation of user input into the SQL query string.
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    try {
        // query() executes the raw string, exposing it to injection
        $stmt = $pdo->query($query); 
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Authentication successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Invalid credentials.';
        }
    } catch (PDOException $e) {
        // Outputting the raw error helps the "attacker" learn SQLi
        $error = 'Database Error: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - VulnWeb</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise</h1>
        <nav><a href="index.php">Home</a> <a href="register.php">Register</a></nav>
    </header>

    <div class="container">
        <h2>Portal Login</h2>
        
        <?php if ($error): ?>
            <div class="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label>Username:</label>
            <input type="text" name="username">
            
            <label>Password:</label>
            <input type="password" name="password">
            
            <input type="submit" value="Log In">
        </form>
        <p><em>Hint: Try logging in with username <code>admin' -- </code></em></p>
    </div>
</body>
</html>
