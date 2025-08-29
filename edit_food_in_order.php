<?php


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
$id = intval($_GET['id']);
$item = $conn->query("SELECT * FROM order_detail WHERE order_detail_id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = intval($_POST['amount']);
    $price = floatval($_POST['price']);
    $total = $amount * $price;

    $stmt = $conn->prepare("UPDATE order_detail SET amount=?, total_price=? WHERE order_detail_id=?");
    $stmt->bind_param("idi", $amount, $total, $id);
    $stmt->execute();

    header("Location: order_report.php");
    exit;
}
include 'header.php';
?>

<form method="post" style="max-width:400px;margin:50px auto">
  <h4>ແກ້ໄຂລາຍການອາຫານ</h4>
  <label>ຈຳນວນ</label>
  <input type="number" name="amount" value="<?= $item['amount'] ?>" class="form-control mb-2">
  <label>ລາຄາ</label>
  <input type="number" name="price" value="<?= $item['total_price'] / $item['amount'] ?>" class="form-control mb-2" step="0.01">
  <button class="btn btn-primary btnf">ອັບເດດ</button>
</form>
