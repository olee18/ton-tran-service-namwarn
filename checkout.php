<?php
session_start();
 if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<div class='alert alert-warning'>Your cart is empty!</div>";
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

// Insert into order table (you can customize fields later)
$conn->query("INSERT INTO `order` (food_name, qty, status_food) VALUES ('Bill Total', 0, 'ຍັງບໍ່ສຳເລັດ')");
$order_id = $conn->insert_id;

// Save order_detail records
foreach ($cart as $item) {
    $stmt = $conn->prepare("INSERT INTO order_detail (amount, food_id, food_name, total_price, order_id, food_status_id)
        VALUES (?, ?, ?, ?, ?, ?)");
    $status = 1; // pending
    $stmt->bind_param("iisdis", $item['amount'], $item['food_id'], $item['food_name'], $item['total'], $order_id, $status);
    $stmt->execute();
}

// Clear cart after saving
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Bill</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-light btnf">

<div class="container mt-5">
  
  <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-4">🧾 ໃບບິນ (Order ID: <?= $order_id ?>)</h3>
        <button onclick="window.print()" class="btn btn-secondary no-print">🖨 Print</button>
    </div>
  
  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ລຳດັບ</th>
        <th>ລາຍການ</th>
        <th>ຈຳນວນ</th>
        <th>ລາຄາ</th>
        <th>ລາຄາລວມ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM order_detail WHERE order_id = $order_id");
      $i = 1;
      $grand_total = 0;
      while ($row = $result->fetch_assoc()):
        $grand_total += $row['total_price'];
      ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= $row['food_name'] ?></td>
          <td><?= $row['amount'] ?></td>
          <td><?= number_format($row['total_price'] / $row['amount'], 2) ?></td>
          <td><?= number_format($row['total_price'], 2) ?></td>
        </tr>
      <?php endwhile; ?>
      <tr class="table-warning fw-bold">
        <td colspan="4" class="text-end">ລວມທັງໝົດ</td>
        <td><?= number_format($grand_total, 2) ?></td>
      </tr>
    </tbody>
  </table>

  <a href="food_list.php" class="btn btn-success">ກັບຄືນລາຍການ</a>
</div>

</body>
</html>