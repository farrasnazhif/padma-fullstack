<?php
include "config/db.php";
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
$o = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Pesanan Sukses — Toko Kopi Padma</title>

    <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: var(--bg);
            font-family: "Inter", sans-serif;
        }

        .success-container {
            width: 90%;
            max-width: 520px;
            margin: 80px auto;
            text-align: center;
        }

        .success-card {
            background: #fff;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 6px 22px rgba(0,0,0,0.08);
        }

        .success-title {
            font-family: "Playfair Display", serif;
            font-size: 32px;
            margin-bottom: 14px;
        }

        .queue-number {
            font-family: "Playfair Display", serif;
            font-size: 46px;
            margin: 14px 0 20px;
            color: #111;
        }

        .success-text {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--accent);
        }

        .btn-home {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 22px;
            border-radius: 25px;
            background: #111;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .btn-home:hover {
            background: #333;
        }

        @media (max-width: 520px) {
            .queue-number {
                font-size: 36px;
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

<div class="success-container">
    <div class="success-card">

        <h1 class="success-title">Pesanan Berhasil!</h1>

        <div class="queue-number">#<?= $o['queue_number'] ?></div>

        <p class="success-text"><strong>Nama:</strong> <?= $o['customer_name'] ?></p>
        <p class="success-text"><strong>WA:</strong> <?= $o['phone'] ?></p>

        <a href="index.php" class="btn-home">Kembali ke Home</a>
    </div>
</div>

</body>
</html>