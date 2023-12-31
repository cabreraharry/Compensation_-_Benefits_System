<?php
include('config.php');

function getCompensationApplications($employeeId, $conn) {
    $query = "SELECT compensation_type, created_at FROM compensation_application WHERE employee_id = $employeeId";
    $result = $conn->query($query);

    if ($result) {
        $applications = [];
        while ($row = $result->fetch_assoc()) {
            $applications[] = $row;
        }
        return $applications;
    }

    return false;
}


function getEmployeeBenefits($employeeId, $conn)
{
    // Fetch benefits information for the employee
    $benefitsQuery = "SELECT * FROM benefits WHERE employee_id = $employeeId";
    $benefitsResult = $conn->query($benefitsQuery);

    if ($benefitsResult->num_rows > 0) {
        $row = $benefitsResult->fetch_assoc();
        $benefits = [];

        if ($row['health_insurance']) {
            $benefits[] = 'Health Insurance';
        }

        if ($row['retirement_plan']) {
            $benefits[] = 'Retirement Plan';
        }

        // Check the value of employee_discount and display accordingly
        $employeeDiscountStatus = ($row['employee_discount'] == 1) ? 'Eligible' : 'Not Eligible';
        $benefits[] = 'Employee Discount (' . $employeeDiscountStatus . ')';


        if (!empty($row['other_benefits'])) {
            $benefits[] = $row['other_benefits'];
        }

        return $benefits;
    }

    return false;
}



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



function authenticateUser($conn, $username, $password) {
    $query = "SELECT * FROM employees WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return null;
}

?>
