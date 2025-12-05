<?php
session_start();

$id = $_GET['id'];

// jika item ada di cart, hapus
if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

header("Location: cart.php");
exit;
?>