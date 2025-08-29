<?php
session_start();
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

$selected = $_POST['food_ids'] ?? [];

foreach ($selected as $food_id) {
    $amount = $_POST['amounts'][$food_id];
    $food = $conn->query("SELECT * FROM food WHERE food_id = $food_id")->fetch_assoc();

    $_SESSION['cart'][$food_id] = [
        'food_id' => $food_id,
        'food_name' => $food['food_name'],
        'amount' => $amount,
        'price' => $food['price'],
        'total' => $amount * $food['price']
    ];
}

header("Location: view_cart.php");