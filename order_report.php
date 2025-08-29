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

$orders = $conn->query("SELECT * FROM `order` ORDER BY order_date DESC");
include 'header.php';
?>


<div class=" mt-5">
  <h3 class="mb-4">📋 ລາຍງານໃບບິນ</h3>
  

  <?php while ($order = $orders->fetch_assoc()): ?>
    <?php $order_id = $order['order_id']; ?>
    <div class="card mb-4 shadow">
      <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Order ID: <?= $order_id ?> | Date: <?= $order['order_date'] ?> | Status: <?= ucfirst($order['status_food']) ?></strong>
        <div>
          <a href="edit_order.php?id=<?= $order_id ?>" class="btn btn-sm btn-primary">ອັບເດດສະຖານະ</a>
          <a href="delete_order.php?id=<?= $order_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">ລົບບິນ</a>
          <a href="view_order_detail.php?id=<?= $order_id ?>" class="btn btn-sm btn-info">ເບິ່ງໃບບິນ</a>
        </div>
      </div>

      <div class="card-body p-0">
        <table class="table table-bordered text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>ລາຍການອາຫານ</th>
              <th>ຈຳນວນ</th>
              <th>ລາຄາ</th>
              <th>ລາຄາລວມ</th>
             
              
              <th>ແກ້ໄຂ</th>
              <th>ລົບລາຍການນີ້</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $details = $conn->query("SELECT * FROM order_detail WHERE order_id = $order_id");
              while ($item = $details->fetch_assoc()):
            ?>
            <tr>
              <form action="update_food_status.php" method="POST">
                <td><?= htmlspecialchars($item['food_name']) ?></td>
                <td><?= $item['amount'] ?></td>
                <td><?= number_format($item['total_price'] / $item['amount'], 2) ?></td>
                <td><?= number_format($item['total_price'], 2) ?></td>
               
              </form>
              <td>
                <a href="edit_food_in_order.php?id=<?= $item['order_detail_id'] ?>" class="btn btn-sm btn-warning">ແກ້ໄຂ</a>
              </td>
              <td>
                <a href="delete_food_in_order.php?id=<?= $item['order_detail_id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Delete this food item?')">ລົບ</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endwhile; ?>
</div>
</div>
</div>
</body>
</html>