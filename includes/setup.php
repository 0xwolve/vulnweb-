<?php
// includes/setup.php
// This script creates the database and populates it with initial data.

$pdo = new PDO('sqlite:' . DB_PATH);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the users table
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        role TEXT NOT NULL DEFAULT 'employee',
        department TEXT NOT NULL,
        salary INTEGER NOT NULL
    )
";
$pdo->exec($createTableQuery);

// Insert demo users
// INTENTIONAL VULNERABILITY: EDUCATIONAL PURPOSE ONLY
// Passwords are intentionally stored in plaintext to demonstrate SQLi and IDOR impacts.
// In reality, passwords MUST be hashed using password_hash().
$insertQuery = "
    INSERT INTO users (username, password, role, department, salary) 
    VALUES 
    ('admin', 'admin123', 'admin', 'IT', 120000),
    ('employee', 'password', 'employee', 'Marketing', 60000),
    ('hacker', '1337', 'employee', 'Security', 75000)
";

try {
    $pdo->exec($insertQuery);
} catch (PDOException $e) {
    // Ignore constraint violations if users already exist
}
?>
