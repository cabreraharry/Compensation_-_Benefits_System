<!-- benefits.php -->

<?php
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('config.php');
include('functions.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$employeeId = $_SESSION['user_id'];

$benefits = getEmployeeBenefits($employeeId, $conn);

$compensationApplications = getCompensationApplications($employeeId, $conn);
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

    <!-- Display existing compensation applications -->
    <h2>Existing Compensation Applications</h2>
    <?php if ($compensationApplications) : ?>
        <ul>
            <?php foreach ($compensationApplications as $application) : ?>
                <li>Compensation Type: <?php echo $application['compensation_type']; ?> - Created At: <?php echo $application['created_at']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No existing compensation applications.</p>
    <?php endif; ?>

    <p style="text-align: center; margin-top: 20px;"><a href="index.php">Go back to Home</a></p>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
