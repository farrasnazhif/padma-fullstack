<?php include "config/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Toko Kopi Padma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Kopi Padma</a>
    <a href="menu.php" class="btn btn-outline-light">Lihat Menu</a>
  </div>
</nav>

<header class="hero text-center text-white">
  <h1>Welcome to Toko Kopi Padma</h1>
  <p>Kopi nikmat, suasana hangat</p>
  <a href="menu.php" class="btn btn-primary">Pesan Sekarang</a>
</header>

<section class="container py-5">
  <h3>Promo Hari Ini</h3>
  <div class="alert alert-info">Diskon 10% untuk pembelian kedua!</div>
</section>

</body>
</html>