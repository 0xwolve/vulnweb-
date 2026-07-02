<?php
// includes/db.php
require_once 'config.php';

function getDBConnection() {
    try {
        $pdo = new PDO('sqlite:' . DB_PATH);
        // Set error mode to exceptions to catch database errors easily
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>
