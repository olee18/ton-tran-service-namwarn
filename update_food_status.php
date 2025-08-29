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


$id = intval($_POST['order_detail_id']);
$status = intval($_POST['food_status_id']);

$stmt = $conn->prepare("UPDATE order_detail SET food_status_id=? WHERE order_detail_id=?");
$stmt->bind_param("ii", $status, $id);
$stmt->execute();

header("Location: order_report.php");
exit;
?>