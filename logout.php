<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');
header("Location: login.php"); // Change this to the appropriate page after logout
exit();
?>