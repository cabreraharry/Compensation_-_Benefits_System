<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <a href="index.php">Home</a>
    
    <?php if (isset($_SESSION['user_id'])) : ?>
   
        <span>Welcome, <?php echo $_SESSION['username']; ?></span>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>
