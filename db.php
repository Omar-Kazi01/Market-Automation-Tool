<?php
// db.php

$host = 'localhost';       // Database server
$user = 'root';            // Database username
$password = '';            // Database password (empty in XAMPP)
$db = 'marketing_tool';    // Database name

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $password, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
