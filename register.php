<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $employeeId = $_POST['employee_id'];

    $sql = "UPDATE employees SET username = ?, password = ? WHERE idemployees = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $password, $employeeId);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['user_id'] = $employeeId;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Error updating user: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Registration</title>
</head>
<body>

<div class="container">
    <h1>User Registration</h1>

    <?php if (isset($error_message)) : ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="employee_id">Employee Id:</label>
        <input type="text" name="employee_id" required>

        <button type="submit" class="button">Register</button>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>

</body>
</html>
