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
$order_id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status_food = $_POST['status_food'];
    $stmt = $conn->prepare("UPDATE `order` SET status_food = ? WHERE order_id = ?");
    $stmt->bind_param("si", $status_food, $order_id);
    $stmt->execute();
    header("Location: order_report.php");
    exit;
}

$order = $conn->query("SELECT * FROM `order` WHERE order_id = $order_id")->fetch_assoc();

$result = $conn->query("SELECT * FROM food_status");
$row = $result->fetch_assoc();


include 'header.php';
?>

<div class="mt-5 center">
    <h4>ແກ້ໄຂ ອໍເດີ້ #<?= $order_id ?></h4><br>
</div>
<div class=" mt-2 center">

    <div>
        <form method="POST">
            <div class="mb-3">
                <label>ສະຖານະ</label>
                <select name="status_food" class="form-select">
                    <option value="<?php echo $row['not_finish']  ?>" <?= $order['status_food'] == 'not_finish' ? 'selected' : '' ?>><?php echo $row['not_finish']  ?></option>
                    <option value="<?php echo $row['finish']  ?>" <?= $order['status_food'] == 'finnish' ? 'selected' : '' ?>><?php echo $row['finish']  ?></option>
                    
                </select>
            </div>
            <button type="submit" class="btn btn-success btnf">ອັບເດດ</button>
            <a href="order_report.php" class="btn btn-secondary">ຍົກເລີກ</a>
        </form>
    </div>
</div>
</div>
</div>
</body>

</html>