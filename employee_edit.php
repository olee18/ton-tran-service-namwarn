<?php
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


$employee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



// Fetch employee by ID
$stmt = $conn->prepare("SELECT * FROM employee WHERE id = ?");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$employee) {
    die("❌ Employee not found.");
}
include 'header.php';
?>


<div class=" mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">ແກ້ໄຂພະນັກງານ</h3>
        <form action="employee_update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">

            <div class="mb-3">
                <label class="form-label">ຊື່</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ເບີໂທ</label>
                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">ລະຫັດຜ່ານໃຫມ່ (leave blank to keep existing)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">ສະຖານະ</label>
                <select name="is_admin" class="form-select" required>
                    <option value="1" <?php if ($employee['is_admin']) echo 'selected'; ?>>admin</option>
                    <option value="0" <?php if (!$employee['is_admin']) echo 'selected'; ?>>user</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 btnf">ຕົກລົງ</button>
        </form>
    </div>
</div>
</div>
</div>

</body>

</html>