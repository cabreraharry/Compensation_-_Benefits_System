<?php
include('config.php'); // Include your database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form data
    $employeeId = isset($_POST['employee_id']) ? intval($_POST['employee_id']) : 0;
    $compensationType = isset($_POST['compensation_type']) ? mysqli_real_escape_string($conn, $_POST['compensation_type']) : '';

    // Perform additional validation as needed

    // Check if employee ID is valid
    if ($employeeId <= 0) {
        // Invalid employee ID
        echo "Invalid Employee ID.";
        exit();
    }

    // Check if compensation type is provided
    if (empty($compensationType)) {
        // Compensation type is required
        echo "Compensation Type is required.";
        exit();
    }

    // Insert the form data into the applications table
    $insertQuery = "INSERT INTO compensation_application (employee_id, compensation_type) VALUES ($employeeId, '$compensationType')";

    if ($conn->query($insertQuery)) {
        // Successfully inserted into the database
        echo "Application submitted successfully.";
    } else {
        // Error in the database query
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect to the homepage if the form was not submitted
    header('Location: index.php');
    exit();
}
?>
