<?php
// Database connection settings
$servername = 'localhost';
$dbname = 'u995835687_collegespace';
$username = 'u995835687_mycollegespace';
$password = 'Spaces10.';

// MySQLi Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check MySQLi connection
if ($conn->connect_error) {
    die("MySQLi connection failed: " . $conn->connect_error);
}

// PDO Connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to Exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If PDO connection fails, display an error message
    die("PDO connection failed: " . $e->getMessage());
}
?>

