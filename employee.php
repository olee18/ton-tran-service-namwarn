<?php include 'header.php'; ?>


<h3 class="mb-4 mt-4">ພະນັກງານ</h3>
<div class="heading1 margin_0">
    <div class="price_table_bottom">
        <div><a class="main_bt" href="employee_add.php">
                <i class=" " style="color: white;"></i>ເພີ່ມ</a></div>
    </div>
</div>
<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark text-center">
        <tr>
            <th>ລະຫັດ</th>
            <th>ຊື່</th>
            <th>ເບີໂທ</th>
            <th>ລະຫັດຜ່ານ</th>
            <th>ສະຖານນະ</th>
            <th>ແກ້ໄຂ</th>
            <th>ລົບ</th>
        </tr>
    </thead>
    <tbody class="text-center">
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

        // Query all employee records
        $sql = "SELECT * FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                echo "<td>" . ($row['is_admin'] ? "admin" : "user") . "</td>";
                echo "<td><a href='employee_edit.php?id=" . $row['id'] . "' ><i style='font-size: 20px;' class='fa fa-edit blue1_color '></i></a></td>";
                echo "<td><a href='employee_delete.php?id=" . $row['id'] . "'  onclick=\"return confirm('Are you sure you want to delete this employee?');\"><i style='font-size: 20px;' class='fa fa-trash red_color'></i></a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No employees found.</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

</div>
</div>
</body>

</html>