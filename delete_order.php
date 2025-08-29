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
$order_id = intval($_GET['id']);

// First delete order details
$conn->query("DELETE FROM order_detail WHERE order_id = $order_id");
// Then delete order
$conn->query("DELETE FROM `order` WHERE order_id = $order_id");

header("Location: order_report.php");
exit;
