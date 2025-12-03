<?php
session_start();
include "config/db.php";

$query = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Menu — Toko Kopi Padma</title>
   <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* PAGE HEADER */
    .menu-header {
      text-align: center;
      padding: 60px 0 20px;
    }
    .menu-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 42px;
      margin-bottom: 10px;
    }
    .menu-header p {
      color: var(--muted);
      max-width: 600px;
      margin: 0 auto;
      font-size: 16px;
    }

    /* MENU GRID */
    .menu-wrapper {
      width: 90%;
      max-width: var(--max-width);
      margin: 40px auto 80px;
    }

    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
    }

    .menu-card {
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .menu-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 22px rgba(0, 0, 0, 0.1);
    }

    .menu-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .menu-card-body {
      padding: 18px;
    }

    .menu-card-body h3 {
      font-size: 20px;
      margin: 0 0 6px;
    }

    .menu-card-body p.desc {
      font-size: 14px;
      color: var(--muted);
      margin-bottom: 10px;
      min-height: 40px;
    }

    .menu-card-body .price {
      font-weight: 700;
      margin-bottom: 10px;
      display: block;
    }

    .menu-card-body .btn-cart {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 25px;
      background: #111;
      color: #fff;
      text-decoration: none;
      font-size: 14px;
      transition: background 0.2s ease;
    }

    .menu-card-body .btn-cart:hover {
      background: #333;
    }
  </style>
</head>

<body>

<!-- HEADER -->
<header class="site-header">
  <nav class="nav container">
    <img src="assets/logo/logo-icon.png" class="icon" alt="Logo Padma">
    <ul class="nav-links">
      <li><a href="index.php#tentang">Tentang</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="index.php#galeri">Galeri</a></li>
      <li><a href="index.php#lokasi">Lokasi</a></li>
    </ul>
  </nav>
</header>

<!-- MENU HEADER -->
<section class="menu-header">
  <h1>Menu Kopi & Kudapan</h1>
  <p>Nikmati racikan kopi dan kudapan khas Padma, diseduh dengan sepenuh hati.</p>
</section>

<!-- MENU LIST -->
<section class="menu-wrapper">
  <div class="menu-grid">

    <?php while($m = mysqli_fetch_assoc($query)) { ?>

    <div class="menu-card">
      <img src="assets/img/<?= $m['image'] ?>" alt="<?= $m['name'] ?>">
      <div class="menu-card-body">
        <h3><?= htmlspecialchars($m['name']) ?></h3>

        <p class="desc"><?= htmlspecialchars($m['description']) ?></p>

        <span class="price">Rp <?= number_format($m['price'], 0, ',', '.') ?></span>

        <a href="add_to_cart.php?id=<?= $m['id'] ?>" class="btn-cart">Tambah ke Keranjang</a>
      </div>
    </div>

    <?php } ?>

  </div>
</section>

<!-- FOOTER -->
<footer class="site-footer container">
  <p>&copy; <span id="year"></span> Toko Kopi Padma. Seduh · Nikmati · Ulangi.</p>
</footer>

<script>
  document.getElementById("year").textContent = new Date().getFullYear();
</script>

</body>
</html>