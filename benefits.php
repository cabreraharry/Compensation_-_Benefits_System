<?php
session_start();

// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include necessary files
include('config.php');
include('functions.php');

// Check if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: login.php');
    exit();
}

// Get the employee ID from the session
$employeeId = $_SESSION['user_id'];

// Fetch benefits information for the logged-in employee
$benefits = getEmployeeBenefits($employeeId, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Benefits</title>
</head>
<body>

<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>

<div class="container">
    <h1>Employee Benefits</h1>

    <?php if ($benefits) : ?>
        <h3>Your Benefits:</h3>
        <ul>
            <?php foreach ($benefits as $benefit) : ?>
                <li><?php echo $benefit; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No benefits information available.</p>
    <?php endif; ?>

    <p style="text-align: center; margin-top: 20px;"><a href="index.php">Go back to Home</a></p>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
