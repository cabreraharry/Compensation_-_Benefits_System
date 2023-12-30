<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <link rel="stylesheet" href="css/style.css">
    <title>Employee Compensation Dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #3498db;
        }

        .homepage-buttons {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
        }

        .button {
            background-color: #3498db;
            color: #fff;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to the Employee Compensation Dashboard</h1>

    <div class="homepage-buttons">
        <a class="button" href="index.php?page=1">View Employee List</a>
        <a class="button" href="apply_compensation.php">Apply for Compensation</a>
        <a class="button" href="benefits.php">Employee Benefits</a>
    </div>
</div>

</body>
</html>
