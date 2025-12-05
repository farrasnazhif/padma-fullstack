<?php
session_start();

foreach ($_POST['qty'] as $id => $qty) {
    $qty = max(1, intval($qty)); // minimal qty = 1
    $_SESSION['cart'][$id]['qty'] = $qty;
}

header("Location: cart.php");
exit;
?>