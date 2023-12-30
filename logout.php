<?php
session_start();

// Check if the user is already logged out
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: login.php');
    exit();
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Remove session cookie
setcookie(session_name(), '', time() - 3600, '/');

// Redirect to the login page or homepage
header("Location: login.php"); // Change this to the appropriate page after logout
exit();
?>
