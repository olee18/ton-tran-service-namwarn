<?php
// DB connection
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

// Get submitted data
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$password_input = $_POST['password'];
$is_admin = $_POST['is_admin'];

// If new password provided, hash and update it
if (!empty($password_input)) {
    $password_hashed = password_hash($password_input, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE employee SET name=?, phone=?, password=?, is_admin=? WHERE id=?");
    $stmt->bind_param("sssii", $name, $phone, $password_hashed, $is_admin, $id);
} else {
    // Update without changing password
    $stmt = $conn->prepare("UPDATE employee SET name=?, phone=?, is_admin=? WHERE id=?");
    $stmt->bind_param("ssii", $name, $phone, $is_admin, $id);
}

if ($stmt->execute()) {
   // echo "<div class='alert alert-success'>✅ Employee updated successfully!</div>";
   header("Location: employee.php");  // Redirect on success
} else {
    echo "<div class='alert alert-danger'>❌ Error: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>
