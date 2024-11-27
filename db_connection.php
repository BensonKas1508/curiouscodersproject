<?php
$host = 'localhost';
$username = 'benson.vorsah';
$password = '1550803';
$dbname = 'webtech_fall2024_benson_vorsah';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!";
}
?>