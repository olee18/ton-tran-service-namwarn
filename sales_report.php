<?php
include 'header.php';
$conn = new mysqli("localhost", "root", "", "tontarn");

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$where = '';

// Total revenue
$total_sales_q = $conn->query("SELECT SUM(total_price) AS total_sales FROM order_detail");
$total_sales = $total_sales_q->fetch_assoc()['total_sales'] ?? 0;

// Total orders
$order_count_q = $conn->query("SELECT COUNT(*) AS order_count FROM `order`");
$order_count = $order_count_q->fetch_assoc()['order_count'] ?? 0;

// Total items sold
$item_count_q = $conn->query("SELECT SUM(amount) AS total_items FROM order_detail");
$total_items = $item_count_q->fetch_assoc()['total_items'] ?? 0;

if ($from && $to) {
  $where = "WHERE o.order_date BETWEEN '$from 00:00:00' AND '$to 23:59:59'";
}

$sql = "
  SELECT o.order_id, o.order_date, od.food_name, od.amount, od.total_price
  FROM order_detail od
  JOIN `order`o ON o.order_id = od.order_id
  $where
  ORDER BY o.order_date DESC
";

$result = $conn->query($sql);
?>



<div class=" mt-5">
  <h3 class="mb-4">📆 ລາຍງານຍອດຂາຍທັງໝົດ</h3>
  <div class="row text-center mb-4">
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5>ລາຍຮັບທັງໝົດ</h5>
          <h2><?= number_format($total_sales, 2) ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-info text-white">
        <div class="card-body">
          <h5>ອໍເດີ້ ທັງໝົດ</h5>
          <h2><?= $order_count ?></h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-warning text-dark">
        <div class="card-body">
          <h5>ຈຳນວນການຂາຍ</h5>
          <h2><?= $total_items ?></h2>
        </div>
      </div>
    </div>
  </div>
<h3 class="mb-4">📆 ລາຍງານຍອດຂາຍຕາມລາຍການອາຫານ</h3>
  <!-- Search Form -->
  <form class="row g-3 mb-4" method="GET">
    <div class="col-md-3">
      <label for="from" class="form-label">ແຕ່ວັນທີ</label>
      <input type="date" class="form-control" name="from" value="<?= $from ?>" required>
    </div>
    <div class="col-md-3">
      <label for="to" class="form-label">ຫາວັນທີ</label>
      <input type="date" class="form-control" name="to" value="<?= $to ?>" required>
    </div>
    <div class="col-md-3 align-self-end">
      <button type="submit" class="btn btn-primary btnf">Search ( ຄົ້ນຫາ )</button>
      <a href="sales_report.php" class="btn btn-secondary">Reset</a>
    </div>
  </form>

  <!-- Report Table -->
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ລຳດັບ</th>
        <th>ລະຫັດອໍເດີ້</th>
        <th>ວ ດ ປ</th>
        <th>ລາຍການອາຫານ</th>
        <th>ຈຳນວນ</th>
        <th>ລາຄາລວມ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      $grand_total = 0;
      while ($row = $result->fetch_assoc()):
        $grand_total += $row['total_price'];
      ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= $row['order_id'] ?></td>
          <td><?= date('Y-m-d', strtotime($row['order_date'])) ?></td>
          <td><?= $row['food_name'] ?></td>
          <td><?= $row['amount'] ?></td>
          <td><?= number_format($row['total_price'], 2) ?></td>
        </tr>
      <?php endwhile; ?>
      <tr class="table-warning text-dark fw-bold">
        <td colspan="5" class="text-end"><h3><b> ລວມທັງໝົດ</b></h3></td>
        <td><h3><b><?= number_format($grand_total, 2) ?></b></h3></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>

</body>

</html>