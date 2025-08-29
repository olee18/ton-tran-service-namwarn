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

$result = $conn->query("SELECT * FROM food");

include 'header.php';
?>

<div class="mt-5">
    <h3 class="mb-4">ເມນູອາຫານ</h3>

    <!-- Form starts here -->
    <form action="add_to_cart.php" method="POST">
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>ລະຫັດ</th>
                    <th>ຊື່</th>
                    <th>ປະເພດ</th>
                    <th>ລາຄາ</th>
                    <th>ເລືອກລາຍການ</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['food_id'] ?></td>
                        <td><?= htmlspecialchars($row['food_name']) ?></td>
                        <td><?= htmlspecialchars($row['food_type']) ?></td>
                        <td><?= number_format($row['price'], 2) ?></td>
                        <td>
                            <input type="checkbox" name="food_ids[]" value="<?= $row['food_id'] ?>"> ເພີ່ມ
                            <input type="hidden" name="amounts[<?= $row['food_id'] ?>]" value="1" class="form-control mt-2">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Centered button -->
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success btn-sm btnf">ເພີ່ມລາຍການອາຫານ</button>
        </div>
    </form>
</div>

</body>
</html>
