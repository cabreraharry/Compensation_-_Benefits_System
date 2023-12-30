<!-- register.php -->

<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Assuming you have a field in your registration form for selecting an employee
    $employeeId = $_POST['employee_id'];

    $sql = "UPDATE employees SET username = '$username', password = '$password' WHERE idemployees = $employeeId";
    
    if ($conn->query($sql) === TRUE) {
        session_start();
        $_SESSION['user_id'] = $employeeId;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>User Registration</h2>

<?php if (isset($error_message)) : ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <!-- Assuming you have a field for selecting an employee during registration -->
    <label for="employee_id">Employee Id:</label>
    <input type="text" name="employee_id" required>

    <button type="submit">Register</button>

    <!-- Add a back button to redirect to login.php -->
    <a href="login.php" class="button">Back to Login</a>
</form>

</body>
</html>
