<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Compensation and Benefits</title>
</head>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header('Location: login.php');
    exit();
}

?>
<body>



<?php
include('config.php');
include('functions.php');
?>

<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>

<?php
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
    include('includes/employee_list.php');
} else {
    include('includes/homepage.php');
}
?>

<?php include('includes/footer.php'); ?>

</body>
</html>
