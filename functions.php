<?php
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
?>
