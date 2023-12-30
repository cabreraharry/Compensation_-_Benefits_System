<?php
$servername = "localhost";
$username = "root";
$password = "9090";
$database = "hrm";

$recordsPerPage = 10; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
