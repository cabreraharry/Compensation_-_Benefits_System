<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <title>Employee Compensation and Benefits</title>
</head>
<body>

<div class="container">
    <h1>Employee List</h1>

    <?php
    include('config.php');
    include('functions.php');

    $result = $conn->query("SELECT * FROM employees");
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Birthdate</th>
            <th>Contact No</th>
            <th>Compensation</th>
            <th>Benefits</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['idemployees']}</td>";
            echo "<td>{$row['first_name']} {$row['middle_name']} {$row['last_name']} {$row['name_extension']}</td>";
            echo "<td>{$row['birthdate']}</td>";
            echo "<td>{$row['contactno']}</td>";
            echo "<td>" . getCompensation($row['idemployees'], $conn) . "</td>";
            echo "<td>" . getBenefits($row['idemployees'], $conn) . "</td>";
            echo "</tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
