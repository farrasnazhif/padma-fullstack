<?php
session_start();
include "config/db.php";

$id = $_POST["id"];
$qty = max(1, intval($_POST["qty"])); // minimal qty = 1

$q = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id");
$m = mysqli_fetch_assoc($q);

if (!$m) {
    die("Menu tidak ditemukan");
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// jika sudah ada, tambahkan qty
if (isset($_SESSION["cart"][$id])) {
    $_SESSION["cart"][$id]["qty"] += $qty;
} else {
    $_SESSION["cart"][$id] = [
        "name" => $m["name"],
        "price" => $m["price"],
        "qty" => $qty
    ];
}

header("Location: cart.php");
exit;
?>