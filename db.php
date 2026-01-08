<?php
$host = "your-rds-endpoint.amazonaws.com";
$user = "admin";
$password = "yourpassword";
$dbname = "contact_app";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
