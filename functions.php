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

function getBenefits($employeeId, $conn)
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

        return implode(', ', $benefits);
    }

    return 'N/A';
}


// functions.php

function displayEmployeeListWithPagination($conn, $currentPage, $recordsPerPage) {
    $start = ($currentPage - 1) * $recordsPerPage;

    $query = "SELECT e.idemployees, e.first_name, e.middle_name, e.last_name, e.name_extension, e.birthdate, e.contactno, s.monthly_salary
              FROM employees e 
              JOIN service_records s ON e.idemployees = s.employees_idemployees
              LIMIT $start, $recordsPerPage";

    $result = $conn->query($query);

    echo "<div class='employee-list-container'>";
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Birthdate</th>";
    echo "<th>Contact No</th>";
    echo "<th>Compensation</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "</div>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['idemployees']}</td>";
        echo "<td>{$row['first_name']} {$row['middle_name']} {$row['last_name']} {$row['name_extension']}</td>";
        echo "<td>{$row['birthdate']}</td>";
        echo "<td>{$row['contactno']}</td>";
    
        // Check if keys exist before accessing them
        $monthlySalary = isset($row['monthly_salary']) ? $row['monthly_salary'] : 'N/A';
    
        echo "<td>{$monthlySalary}</td>";
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
?>
