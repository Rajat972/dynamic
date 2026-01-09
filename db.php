<?php
$host = "html-testing-db.cg3uoe4ga0f3.us-east-1.rds.amazonaws.com";
$user = "admin";
$pass = "Rajat0117";
$db   = "contactdb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("DB connection failed");
}
?>
