<?php
session_start();

if (isset($_POST['amounts'])) {
    foreach ($_POST['amounts'] as $id => $amount) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['amount'] = $amount;
            $_SESSION['cart'][$id]['total'] = $amount * $_SESSION['cart'][$id]['price'];
        }
    }
}

header("Location: view_cart.php");