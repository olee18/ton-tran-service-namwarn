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

require 'header.php';

?>

<!--Foods-->
<div class="mt-5">
    <h3 class="mb-4">ລາຍການອາຫານ & ເຄື່ອງດື່ມ</h3>
    <div class="heading1 margin_0">
        <div class="price_table_bottom">
            <div><a class="main_bt" href="food_add.php">
                    <i class=" " style="color: white;"></i>ເພີ່ມ</a></div>
        </div>
    </div>
    <div class="row">
        <?php

        // Define the type to filter by
        $type = "food"; // Replace with actual type value or get from URL/query

        // Query to select filtered data
        $sql = "SELECT * FROM food WHERE food_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();

        // Loop through and display each item
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3 mb-4">';
            echo '  <div class="card shadow-sm p-3">';
            echo '    <h5 class="card-title">' . htmlspecialchars($row["food_name"]) . '</h5>';
            echo '    <p class="card-text text-muted">Price: ' . number_format($row["price"], 2) . '</p>';
            echo "<td><a href='food_edit.php?id=" . $row['food_id'] . "' ><i style='font-size: 20px;' class='fa fa-edit blue1_color '></i></a></td>";
            echo "<td><a href='food_delete.php?id=" . $row['food_id'] . "'  onclick=\"return confirm('Are you sure you want to delete this employee?');\"><i style='font-size: 20px;' class='fa fa-trash red_color'></i></a></td>";
            echo '  </div>';
            echo '</div>';
        }


        // Define the type to filter by
        $type = "drink"; // Replace with actual type value or get from URL/query

        // Query to select filtered data
        $sql = "SELECT * FROM food WHERE food_type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();

        // Loop through and display each item
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3 mb-4">';
            echo '  <div class="card shadow-sm p-3">';
            echo '    <h5 class="card-title">' . htmlspecialchars($row["food_name"]) . '</h5>';
            echo '    <p class="card-text text-muted">Price: ' . number_format($row["price"], 2) . '</p>';
            echo "<td><a href='food_edit.php?id=" . $row['food_id'] . "' ><i style='font-size: 20px;' class='fa fa-edit blue1_color '></i></a></td>";
            echo "<td><a href='food_delete.php?id=" . $row['food_id'] . "'  onclick=\"return confirm('Are you sure you want to delete this employee?');\"><i style='font-size: 20px;' class='fa fa-trash red_color'></i></a></td>";
            echo '  </div>';
            echo '</div>';
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>

</div>
</div>


</body>

</html>