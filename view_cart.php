<?php
 include 'header.php';
$cart = $_SESSION['cart'] ?? [];
?>

<div class="container mt-4">
  <h3>Your Cart</h3>
  <form action="update_cart.php" method="post">
  <table class="table table-bordered " style="width: 850px;">
    <thead>
      <tr>
        <th>ລາຍການອາຫານ</th>
        <th>ຈຳນວນ</th>
        <th>ລາຄາ</th>
        <th>ລາຄາລວມ</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $id => $item): ?>
        <tr>
          <td><?= $item['food_name'] ?></td>
          <td>
            <input type="number" name="amounts[<?= $id ?>]" value="<?= $item['amount'] ?>" class="form-control " style="width: 80px;" min="1">
          </td>
          <td><?= $item['price'] ?></td>
          <td><?= $item['total'] ?></td>
          <td>
            <a href="delete_cart.php?id=<?= $id ?>" class="btn btn-danger btn-sm">ລົບ</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="food_list.php" class="btn btn-primary">ສັ່ງອາຫານເພີ່ມ</a>
  <a href="checkout.php" class="btn btn-success">ຢືນຍັນ</a>
  <button type="submit" class="btn btn-info btnf">ອັບເດດ</button>
  </form>

</div>