<?php
// register.php
require_once 'includes/db.php';

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $department = $_POST['department'] ?? 'General';

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        $pdo = getDBConnection();
        // Here we use Prepared Statements - this part is SECURE from SQLi
        // We do this to show the contrast between secure (here) and insecure (login.php)
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        
        if ($stmt->fetch()) {
            $error = 'Username already exists.';
        } else {
            // INTENTIONAL: Storing plaintext password for educational purposes.
            $insertStmt = $pdo->prepare("INSERT INTO users (username, password, department, salary) VALUES (:username, :password, :department, 50000)");
            $insertStmt->execute([
                'username' => $username,
                'password' => $password,
                'department' => $department
            ]);
            $success = 'Registration successful! You may now login.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - VulnWeb</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>VulnWeb Enterprise</h1>
        <nav><a href="index.php">Home</a> <a href="login.php">Login</a></nav>
    </header>

    <div class="container">
        <h2>Employee Registration</h2>
        
        <?php if ($error): ?>
            <div class="alert"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div style="color: green; font-weight:bold; margin-bottom: 15px;"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <label>Department:</label>
            <input type="text" name="department" value="General">
            
            <input type="submit" value="Register Account">
        </form>
    </div>
</body>
</html>
