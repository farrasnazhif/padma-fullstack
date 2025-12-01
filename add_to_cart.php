<?php
session_start();
include "config/db.php";

$id = $_GET['id'];

$menu = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id");
$item = mysqli_fetch_assoc($menu);

if (!$item) die("Menu tidak ditemukan");

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = [
        "name" => $item['name'],
        "price" => $item['price'],
        "qty" => 1
    ];
} else {
    $_SESSION['cart'][$id]["qty"]++;
}

header("Location: cart.php");
?>