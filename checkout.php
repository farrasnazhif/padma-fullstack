<?php
session_start();
include "config/db.php";
include "config/midtrans.php";

$cart = $_SESSION['cart'] ?? [];
if (!$cart) header("Location: menu.php");

$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Checkout — Toko Kopi Padma</title>

    <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />
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
        display: block;
    }

    input, select {
        width: 100%;
        padding: 12px 14px;
        font-size: 15px;
        border-radius: 8px;
        border: 1px solid #cfcfcf;
        margin-bottom: 18px;
        background: #fff;
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

<div class="checkout-container">

    <h1 class="checkout-title">Checkout</h1>

    <div class="checkout-card">
      <form id="checkout-form">

        <label>Nama</label>
        <input type="text" name="name" required>

        <label>Nomor WA</label>
        <input type="text" name="phone" required>

        <label>Takeaway / Dine-in</label>
        <select name="type" required>
          <option value="takeaway">Takeaway</option>
          <option value="dinein">Dine-in</option>
        </select>

        <h4>Total: Rp <?= number_format($total) ?></h4>

        <button type="submit" class="btn-submit">
          Bayar dengan Midtrans
        </button>

      </form>
    </div>

</div>

<!-- Snap.js → client key aman dari backend -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?= midtrans_client_key() ?>"></script>

<script>
document.getElementById("checkout-form").addEventListener("submit", async (e) => {
    e.preventDefault();

    const body = {
        name: e.target.name.value,
        phone: e.target.phone.value,
        type: e.target.type.value
    };

    const res = await fetch("create_order.php", {
        method: "POST",
        body: JSON.stringify(body)
    });

    const json = await res.json();

    snap.pay(json.snap_token, {
        onSuccess: () => window.location.href = "checkout_success.php?id=" + json.order_id,
        onPending: () => alert("Menunggu pembayaran…"),
        onError: () => alert("Pembayaran gagal"),
    });
});
</script>

</body>
</html>