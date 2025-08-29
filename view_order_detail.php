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

$order_id = intval($_GET['id'] ?? 0);
$order = $conn->query("SELECT * FROM `order` WHERE order_id = $order_id")->fetch_assoc();

if (!$order) {
    die("❌ Order not found.");
}

$details = $conn->query("SELECT * FROM order_detail WHERE order_id = $order_id");

include 'header.php';
?>
<style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>


<div class=" mt-5">
  <div class="card shadow">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-4"><h3>
        <button onclick="window.print()" class="btn btn-secondary no-print">🖨 Print</button>
    </div>
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>🧾 Order #<?= $order_id ?> Details</h4>
      <a href="order_report.php" class="btn btn-secondary btn-sm">← ກັບຄືນ</a>
    </div>
    

    <div class="card-body">
      <p><strong>Date:</strong> <?= $order['order_date'] ?></p>
      
      <hr>

     
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>ລາຍການອາຫານ</th>
            <th>ຈຳນວນ</th>
            <th>ລາຄາລວມ</th>
            <th>ລາຄາລວມ</th>
            
          </tr>
        </thead>
        <tbody>
          <?php 
          $i = 1; $grand_total = 0;
          while ($item = $details->fetch_assoc()):
            $unit_price = $item['total_price'] / $item['amount'];
            $grand_total += $item['total_price'];
          ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($item['food_name']) ?></td>
            <td><?= $item['amount'] ?></td>
            <td><?= number_format($unit_price, 2) ?></td>
            <td><?= number_format($item['total_price'], 2) ?></td>
            
          </tr>
          <?php endwhile; ?>
          <tr class="fw-bold">
            <td colspan="4" class="text-end">ລວມທັງໝົດ</td>
            <td colspan="2"><?= number_format($grand_total, 2) ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>