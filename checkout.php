<?php
session_start();
include "config/db.php";

$cart = $_SESSION['cart'] ?? [];
if (!$cart) header("Location: menu.php");

$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];

if ($_POST) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    $q = mysqli_query($conn, "SELECT COUNT(*) AS c FROM orders WHERE DATE(created_at)=CURDATE()");
    $queue = mysqli_fetch_assoc($q)['c'] + 1;

    mysqli_query($conn,
      "INSERT INTO orders(customer_name,phone,type,total_price,queue_number)
       VALUES('$name','$phone','$type','$total','$queue')");

    $order_id = mysqli_insert_id($conn);

    foreach ($cart as $id => $c) {
        mysqli_query($conn,
          "INSERT INTO order_items(order_id,menu_id,quantity,price)
           VALUES('$order_id','$id','".$c['qty']."','".$c['price']."')");
    }

    unset($_SESSION['cart']);
    header("Location: checkout_success.php?id=".$order_id);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Checkout — Toko Kopi Padma</title>

    <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .checkout-container {
            width: 90%;
            max-width: 680px;
            margin: 60px auto;
        }

        .checkout-title {
            font-family: "Playfair Display", serif;
            font-size: 34px;
            text-align: center;
            margin-bottom: 32px;
        }

        .checkout-card {
            background: #fff;
            padding: 26px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.06);
        }

        label {
            font-weight: 600;
            margin-bottom: 4px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            border-radius: 8px;
            border: 1px solid #cfcfcf;
            margin-bottom: 18px;
        }

        .total-line {
            font-size: 20px;
            font-weight: 700;
            margin-top: 6px;
            text-align: right;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 14px;
            border-radius: 25px;
            background: #111;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #333;
        }

        @media (max-width: 520px) {
            .checkout-card {
                padding: 20px;
            }
            .checkout-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header class="site-header">
  <nav class="nav container">
    <img src="assets/logo/logo-icon.png" class="icon" alt="Logo Padma">
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="index.php#galeri">Galeri</a></li>
      <li><a href="index.php#lokasi">Lokasi</a></li>
    </ul>
  </nav>
</header>

<!-- MAIN CHECKOUT -->
<div class="checkout-container">

    <h1 class="checkout-title">Checkout</h1>

    <div class="checkout-card">
        <form method="post">

            <label>Nama Pelanggan</label>
            <input type="text" name="name" required placeholder="Masukkan nama anda">

            <label>Nomor WA</label>
            <input type="text" name="phone" required placeholder="08xxxx">

            <label>Metode</label>
            <select name="type">
                <option value="takeaway">Takeaway</option>
                <option value="dinein">Dine-in</option>
            </select>

            <p class="total-line">Total: Rp <?= number_format($total, 0, ',', '.') ?></p>

            <button class="btn-submit">Kirim Pesanan</button>
        </form>
    </div>

</div>

</body>
</html>