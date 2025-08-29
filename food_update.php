<?php
// Database connection
session_start();

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
$food_id = $_POST['food_id'];
$food_name = $_POST['food_name'];
$food_type = $_POST['food_type'];
$price = $_POST['price'];


// Update
$stmt = $conn->prepare("UPDATE food SET food_name = ?, food_type = ?, price = ? WHERE food_id = ?");
$stmt->bind_param("ssdi", $food_name, $food_type, $price, $food_id);

if ($stmt->execute()) {
    
    header("Location: food.php");  // Redirect on success
} else {
    echo "❌ Error updating: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
