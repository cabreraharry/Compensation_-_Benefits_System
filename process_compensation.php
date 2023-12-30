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

    // Additional fields for Employee Loan
    $startDate = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : '';
    $endDate = isset($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : '';
    $comments = isset($_POST['comments']) ? mysqli_real_escape_string($conn, $_POST['comments']) : '';

    // Insert the form data into the applications table
    $insertQuery = "INSERT INTO compensation_application (employee_id, compensation_type, start_date, end_date, comments) 
                    VALUES ($employeeId, '$compensationType', '$startDate', '$endDate', '$comments')";

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
