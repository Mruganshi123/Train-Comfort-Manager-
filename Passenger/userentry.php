<?php
include 'conn.php';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email_id, password, confirmpw, phone_number, address, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email_id, $password, $confirm_password, $phone_number, $address, $role);

// Get form data
$name = $_POST['reg-name'];

$email_id = ($_POST['email_id']);
$password = password_hash($_POST['reg-password'], PASSWORD_DEFAULT); // Hash the password for security
$confirm_password = password_hash($_POST['confirm-password'], PASSWORD_DEFAULT); // Hash the confirm password for security
$phone_number = $_POST['phone'];
$address = $_POST['address'];
$role = $_POST['role'];

// Check if passwords match (optional if both are hashed)
if (!password_verify($_POST['confirm-password'], $password)) {
    die("Passwords do not match.");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
