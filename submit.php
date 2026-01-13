<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['message'];

    $stmt = $conn->prepare(
        "INSERT INTO contacts (name,email,phone,message) VALUES (?,?,?,?)"
    );
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Error saving data";
    }

    $stmt->close();
    $conn->close();
}
?>
