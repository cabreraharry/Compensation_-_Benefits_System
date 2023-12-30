<?php

include('config.php');
function getCompensation($employeeId, $conn)
{
    $result = $conn->query("SELECT * FROM service_records WHERE employees_idemployees = $employeeId ORDER BY appointment_start_date DESC LIMIT 1");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['monthly_salary'];
    }

    return 'N/A';
}

function getEmployeeBenefits($employeeId, $conn)
{
    $result = $conn->query("SELECT * FROM benefits WHERE employee_id = $employeeId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $benefits = [];

        if ($row['health_insurance']) {
            $benefits[] = 'Health Insurance';
        }

        if ($row['retirement_plan']) {
            $benefits[] = 'Retirement Plan';
        }

        // You can add more conditions based on your benefits table columns.

        if (!empty($row['other_benefits'])) {
            $benefits[] = $row['other_benefits'];
        }

        return $benefits;
    }

    return false;
}


// functions.php

function displayEmployeeListWithPagination($conn, $currentPage, $recordsPerPage) {
    $start = ($currentPage - 1) * $recordsPerPage;

    $query = "SELECT e.idemployees, e.first_name, e.middle_name, e.last_name, e.name_extension, e.birthdate, e.contactno, s.monthly_salary, j.job_category
              FROM employees e 
              JOIN service_records s ON e.idemployees = s.employees_idemployees
              LEFT JOIN job_positions j ON e.job_position_id = j.idjob_positions
              LIMIT $start, $recordsPerPage";

    $result = $conn->query($query);

    // echo "<div class='employee-list-container'>";
    // echo "<table>";
    // echo "<thead>";
    // echo "<tr>";
    // echo "<th>ID</th>";
    // echo "<th>Name</th>";
    // echo "<th>Birthdate</th>";
    // echo "<th>Contact No</th>";
    // echo "<th>Salary</th>";
    // echo "<th>Job Position</th>";
    // echo "</tr>";
    // echo "</thead>";
    // echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['idemployees']}</td>";
        echo "<td>{$row['first_name']} {$row['middle_name']} {$row['last_name']} {$row['name_extension']}</td>";
        echo "<td>{$row['birthdate']}</td>";
        echo "<td>{$row['contactno']}</td>";

        // Check if keys exist before accessing them
        $monthlySalary = isset($row['monthly_salary']) ? $row['monthly_salary'] : 'N/A';
        $jobPosition = isset($row['job_category']) ? $row['job_category'] : 'N/A';

        echo "<td>{$monthlySalary}</td>";
        echo "<td>{$jobPosition}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>"; 
}



function getTotalRecords($conn)
{
    $result = $conn->query("SELECT COUNT(*) AS total FROM employees");
    $row = $result->fetch_assoc();
    return $row['total'];
}

// functions.php

function authenticateUser($conn, $username, $password) {
    $query = "SELECT * FROM employees WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Use password_verify to check if the entered password matches the hashed password
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return null; // Invalid credentials
}

?>
