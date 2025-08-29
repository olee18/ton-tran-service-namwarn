<?php
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

echo "Connected successfully to tontarn database!";


// Get data from the form
$food_id = $_POST['id'];
$food_name = $_POST['name'];
$food_type = $_POST['type'];
$price = $_POST['price'];


// Prepare and bind
$stmt = $conn->prepare("INSERT INTO food (food_id, food_name, food_type, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issd", $food_id, $food_name, $food_type, $price);

// Execute and give feedback
if ($stmt->execute()) {
    header("Location: food.php");  // Redirect on success
} else {
    echo "❌ Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
