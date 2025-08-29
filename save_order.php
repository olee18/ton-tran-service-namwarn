<?php
session_start();
 if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    die("❌ Your cart is empty.");
}

// DB connection
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

$result = $conn->query("SELECT * FROM food_status");
$row = $result->fetch_assoc();

// Create a new order_id (or use auto-increment in DB)
$order_id = rand(10000, 99999);
$order_date = date('Y-m-d H:i:s');
$status_food = $row['not_finish']; 
$food_names = array_column($cart, 'food_name');
$food_name_summary = implode(", ", $food_names);
$total_qty = array_sum(array_column($cart, 'amount'));

// Insert into `order`
$stmt = $conn->prepare("INSERT INTO `order` (order_id, food_name, qty, status_food, order_date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isiss", $order_id, $food_name_summary, $total_qty, $status_food, $order_date);
$stmt->execute();

// Insert each cart item into `order_detail`
foreach ($cart as $item) {
    $stmt = $conn->prepare("INSERT INTO order_detail (amount, food_id, food_name, total_price, order_id, food_status_id) VALUES (?, ?, ?, ?, ?, ?)");
    $food_status_id = 1 ; // Example: 1 = ຍັງບໍ່ສຳເລັດ
    $stmt->bind_param("iisddi", 
        $item['amount'], 
        $item['food_id'], 
        $item['food_name'], 
        $item['total_price'], 
        $order_id, 
        $food_status_id
    );
    $stmt->execute();
}

$stmt->close();
$conn->close();

// Clear cart
unset($_SESSION['cart']);
include 'header.php';
?>

<!-- ✅ BILL DISPLAY -->


<div class=" mt-5">
  <div class="card shadow p-4">
    <h3 class="mb-3 text-center">🧾 ໃບບິນ</h3>
    <p><strong>Order ID:</strong> <?= $order_id ?></p>
    <p><strong>Date:</strong> <?= $order_date ?></p>
    <p><strong>Status:</strong> <?= ucfirst($status_food) ?></p>
    <p><strong>Items:</strong> <?= htmlspecialchars($food_name_summary) ?></p>
    <p><strong>Total Quantity:</strong> <?= $total_qty ?></p>

    <hr>

    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>ລາຍການອາຫານ</th>
          <th>ຈຳນວນ</th>
          <th>ລາຄາ</th>
          <th>ລາຄາລວມ</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; foreach ($cart as $item): ?>
        <tr>
          <td><?= htmlspecialchars($item['food_name']) ?></td>
          <td><?= $item['amount'] ?></td>
          <td><?= number_format($item['price'], 2) ?></td>
          <td><?= number_format($item['total_price'], 2) ?></td>
        </tr>
        <?php $total += $item['total_price']; endforeach; ?>
        <tr class="fw-bold">
          <td colspan="3" class="text-end">ລວມທັງໝົດ</td>
          <td><?= number_format($total, 2) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="text-center">
      <a href="food_list.php" class="btn btn-primary mt-3">← ກັບຄືນເມນູອາຫານ</a>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>
