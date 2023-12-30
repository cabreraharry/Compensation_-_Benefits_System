<!-- apply_compensation.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/style.css">
    <title>Apply for Compensation</title>
</head>
<body>

<div class="container">
    <h1>Apply for Compensation</h1>

    <form action="process_compensation.php" method="post">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" required>

        <label for="compensation_type">Compensation Type:</label>
        <select name="compensation_type" required>
            <option value="retirement">Retirement</option>
            <option value="resignation">Resignation</option>
            <option value="other">Other</option>
        </select>

        <!-- Add more form fields based on your requirements -->

        <button type="submit" class="button">Submit Application</button>
    </form>

    <!-- Back to homepage link -->
    <p style="text-align: center; margin-top: 20px;"><a href="index.php">Go back to Home</a></p>
</div>

</body>
</html>
