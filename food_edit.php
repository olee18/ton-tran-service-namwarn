<?php
// Database connection


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
include 'header.php';
// Get food_id from URL
$food_id = isset($_GET['id']) ? intval($_GET['id']) : 0;



// Get current food item
$stmt = $conn->prepare("SELECT * FROM food WHERE food_id = ?");
$stmt->bind_param("i", $food_id);
$stmt->execute();
$result = $stmt->get_result();
$food = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$food) {
    die("Food item not found.");
}
?>


<div class=" mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h3 class="text-center mb-4">ແກ້ໄຂລາຍການອາຫານ</h3>
                <form action="food_update.php" method="POST">
                    <input type="hidden" name="food_id" value="<?php echo $food['food_id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">ຊື່ອາຫານ</label>
                        <input type="text" class="form-control" name="food_name" value="<?php echo $food['food_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ປະເພດອາຫານ</label>
                        <select class="form-select" name="food_type" required>
                            <option value="Food" <?php if ($food['food_type'] == 'Food') echo 'selected'; ?>>ອາຫານ</option>
                            <option value="Drink" <?php if ($food['food_type'] == 'Drink') echo 'selected'; ?>>ເຄື່ອງດື່ມ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ລາຄາ</label>
                        <input type="number" step="0.01" class="form-control" name="price" value="<?php echo $food['price']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 btnf">ຕົກລົງ</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
