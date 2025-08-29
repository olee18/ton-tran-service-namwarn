<?php
// Database connection
session_start();

 if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "tontarn";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$password_input = $_POST['password'];
$is_admin = $_POST['is_admin'];

// Optional: hash password for security (recommended)
//$password_hashed = password_hash($password_input, PASSWORD_DEFAULT);



// Prepare and bind SQL
$stmt = $conn->prepare("INSERT INTO employee (id, name, phone, password, is_admin) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $id, $name, $phone, $password_input, $is_admin);

// Execute insert
if ($stmt->execute()) {
    //echo "<div class='alert alert-success'>✅ Employee added successfully!</div>";
    header("Location: employee.php");  // Redirect on success
} else {
    echo "<div class='alert alert-danger'>❌ Error: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>
