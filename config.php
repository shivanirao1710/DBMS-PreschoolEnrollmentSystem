<?php
$host = 'localhost';       // MySQL server
$username = 'root';        // MySQL username
$password = '';            // MySQL password (usually empty for local development)
$dbname = 'preschool';     // Database name

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
