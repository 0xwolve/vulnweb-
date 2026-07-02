<?php
// logout.php
require_once 'includes/config.php';

// Empty the session array
$_SESSION = [];

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session data on the server
session_destroy();

// Redirect back to the homepage
header("Location: index.php");
exit;
?>
