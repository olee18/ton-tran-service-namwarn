<?php
// Database connection settings
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

// Get food_id from GET or POST
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if food_id is valid
if ($id <= 0) {
    die("❌ Invalid ID.");
}



// Prepare and execute delete
$stmt = $conn->prepare("DELETE FROM employee WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
     header("Location: employee.php");  // Redirect on success
} else {
    echo "❌ Error deleting item: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>