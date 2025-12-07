<?php
session_start();
include "config/db.php";

$query = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  
  <title>Menu | Toko Kopi Padma</title>
 <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    /* PAGE HEADER */
    .menu-header {
      text-align: center;
      padding: 60px 0 20px;
    }
    .menu-header h1 {
      font-family: "Playfair Display", serif;
      font-size: 38px;
      margin-bottom: 10px;
    }
    .menu-header p {
      color: var(--muted);
      max-width: 400px;
      margin: 0 auto;
      font-size: 16px;
    }


    /* HEADER FIX */
    .site-header {
      padding: 16px 0;
      background: transparent;
    }

    /* PAGE WRAPPER */
    .menu-wrapper {
      width: 90%;
      max-width: var(--max-width);
      margin: 40px auto 80px;
    }

    /* GRID */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 24px;
    }

    /* CARD */
    .menu-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 14px rgba(0,0,0,0.06);
      display: flex;
      flex-direction: column;
    }

    .menu-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .menu-card-body {
      padding: 18px;
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex-grow: 1;
    }

    .menu-card-body h3 {
      font-size: 20px;
      margin: 0;
    }

    .menu-card-body p.desc {
      font-size: 14px;
      color: var(--muted);
      margin: 0;
      min-height: 40px;
    }

    .price {
      font-weight: 700;
      margin-top: 4px;
      margin-bottom: 12px;
      display: block;
    }

    /* ADD CART FORM */
    .add-cart-form {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
      margin-top: auto;
    }

    .qty-input {
      width: 60px;
      padding: 9px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
      text-align: center;
    }

    .btn-cart {
      flex-grow: 1;
      padding: 10px;
      border-radius: 25px;
      background: #111;
      color: white;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }

    .btn-cart:hover {
      background: #333;
    }

    @media (max-width: 520px) {
      .qty-input {
        width: 50px;
      }
    }
  </style>
</head>

<body>

<header class="site-header">
  <nav class="nav container">
    <img src="assets/logo/logo-icon.png" class="icon" alt="Padma Logo">
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="menu.php" class="active">Menu</a></li>
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

<section class="menu-wrapper">
  <div class="menu-grid">

  <?php while($m = mysqli_fetch_assoc($query)) { ?>
  
    <div class="menu-card">
      <img src="assets/img/<?= $m['image'] ?>" alt="<?= htmlspecialchars($m['name']) ?>">

      <div class="menu-card-body">

        <h3><?= htmlspecialchars($m['name']) ?></h3>

        <p class="desc"><?= htmlspecialchars($m['description']) ?></p>

        <span class="price">Rp <?= number_format($m['price'], 0, ',', '.') ?></span>

        <!-- ADD TO CART FORM -->
        <form action="add_to_cart.php" method="POST" class="add-cart-form">
          <input type="hidden" name="id" value="<?= $m['id'] ?>">

          <input type="number" name="qty" min="1" value="1" class="qty-input">

          <button type="submit" class="btn-cart">Tambah</button>
        </form>

      </div>
    </div>

  <?php } ?>

  </div>
</section>

</body>
</html>