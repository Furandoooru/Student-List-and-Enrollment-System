<?php
$host = 'localhost';
$user = 'root'; // your MySQL username (default is root for XAMPP)
$pass = '';     // your MySQL password (empty for XAMPP)
$db_name = 'school_system'; // database name

$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
