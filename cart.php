<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Keranjang - Toko Kopi Padma</title>

    <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- GLOBAL SITE STYLES -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: var(--bg);
            font-family: "Inter", sans-serif;
        }

        .cart-container {
            width: 90%;
            max-width: 780px;
            margin: 60px auto;
        }

        .cart-title {
            font-family: "Playfair Display", serif;
            font-size: 36px;
            margin-bottom: 20px;
            text-align: center;
        }

        .cart-card {
            background: #fff;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        /* Cart Item Row */
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-name {
            font-size: 16px;
            font-weight: 600;
        }

        .item-qty {
            font-size: 15px;
            color: var(--muted);
        }

        .item-price {
            font-weight: 700;
            font-size: 16px;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .total-section h3 {
            font-size: 22px;
            font-weight: 700;
        }

        .btn-checkout {
            display: inline-block;
            margin-top: 14px;
            padding: 12px 22px;
            border-radius: 25px;
            background: #111;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .btn-checkout:hover {
            background: #333;
        }

        .empty-cart {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
            font-size: 18px;
            font-weight: 600;
            color: var(--muted);
        }

        @media (max-width: 520px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
            .total-section {
                text-align: center;
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

<div class="cart-container">

    <h1 class="cart-title">Keranjang Pesanan</h1>

    <?php if (!$cart) { ?>

    <div class="empty-cart">Keranjang anda masih kosong ☕</div>

    <?php } else { ?>

    <div class="cart-card">
        <?php foreach ($cart as $id => $c) { ?>
            <div class="cart-item">
                <div>
                    <div class="item-name"><?= $c['name'] ?></div>
                    <div class="item-qty">Qty: <?= $c['qty'] ?></div>
                </div>

                <div class="item-price">
                    Rp <?= number_format($c['qty'] * $c['price'], 0, ',', '.') ?>
                </div>
            </div>
        <?php } ?>

        <div class="total-section">
            <h3>Total: Rp <?= number_format($total, 0, ',', '.') ?></h3>
            <a href="checkout.php" class="btn-checkout">Lanjut ke Checkout</a>
        </div>
    </div>

    <?php } ?>

</div>

</body>
</html>