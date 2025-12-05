<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../config/db.php";

$id = intval($_GET['id']);

// hapus semua item pesanan
mysqli_query($conn, "DELETE FROM order_items WHERE order_id = $id");

// hapus pesanan utama
mysqli_query($conn, "DELETE FROM orders WHERE id = $id");

header("Location: dashboard.php");
exit;