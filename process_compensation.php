<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = isset($_POST['employee_id']) ? intval($_POST['employee_id']) : 0;
    $compensationType = isset($_POST['compensation_type']) ? mysqli_real_escape_string($conn, $_POST['compensation_type']) : '';

    if ($employeeId <= 0) {
        echo "Invalid Employee ID.";
        exit();
    }

    if (empty($compensationType)) {
        echo "Compensation Type is required.";
        exit();
    }

    $startDate = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : '';
    $endDate = isset($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : '';
    $comments = isset($_POST['comments']) ? mysqli_real_escape_string($conn, $_POST['comments']) : '';

    $insertQuery = "INSERT INTO compensation_application (employee_id, compensation_type, start_date, end_date, comments) 
                    VALUES ($employeeId, '$compensationType', '$startDate', '$endDate', '$comments')";

    if ($conn->query($insertQuery)) {
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    header('Location: index.php');
    exit();
}
?>
