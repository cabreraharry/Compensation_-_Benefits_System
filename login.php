<?php
include('config.php');
include('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $user = authenticateUser($conn, $username, $password);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['idemployees'];
        $_SESSION['username'] = $user['username'];

        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>

<div class="container">
    <h1>Login</h1>

    <?php if (isset($error)) : ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="button">Login</button>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>

</body>
</html>
