<?php
include 'db.php';

$name    = $_POST['name'];
$email   = $_POST['email'];
$phone   = $_POST['phone'];
$message = $_POST['message'];

$sql = "INSERT INTO contacts (name,email,phone,message)
        VALUES ('$name','$email','$phone','$message')";

if ($conn->query($sql)) {
    echo "Thank you! Data saved.";
} else {
    echo "Error";
}

$conn->close();
?>
