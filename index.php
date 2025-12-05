<?php
// Koneksi database (opsional, tetap disertakan)
include "config/db.php";
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Toko Kopi Padma — Nikmati Setiap Seduhan</title>
    <link rel="icon" type="image/png" href="assets/logo/logoheader.png" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600;800&display=swap"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>
    <!-- NAVBAR -->
    <header class="site-header">
      <nav class="nav container">
        <img src="assets/logo/logo-icon.png" alt="padma icon" class="icon" />
        <ul class="nav-links">
          <li><a href="#tentang">Tentang</a></li>
          <li><a href="#menu">Menu</a></li>
          <li><a href="#galeri">Galeri</a></li>
          <li><a href="#lokasi">Lokasi</a></li>
          <li><a href="/padma/cart.php">Keranjang</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <!-- HERO -->
      <section class="hero">
        <div class="hero-header">
          <h1 class="hero-title">TOKO KOPI PADMA.</h1>
        </div>

        <div class="hero-image">
          <img src="assets/images/hero-image.jpg" alt="Kedai kopi Padma" />
        </div>

        <div class="hero-content">
          <p class="bold">
            Pengalaman tersaji untuk semua kebutuhan dan momen ngopi Anda.
          </p>
          <p>
            Desain minimalis berpadu pesona industrial, menghadirkan pengalaman
            kopi yang merayakan kualitas, kesederhanaan, dan kebersamaan.
          </p>
        </div>

        <div class="hero-cta">
          <a href="menu.php" class="btn">Pesan Sekarang</a>
        </div>
      </section>

      <!-- ABOUT -->
      <section id="tentang" class="section container about">
        <div class="section-left">
          <h2>Tentang</h2>
          <h3>Toko Kopi Padma</h3>
          <p>
            Toko Kopi Padma tidak hanya tentang kopi enak, tapi juga tentang
            suasana hangat. Tim kami bukan sekadar barista — mereka adalah
            sahabat pecinta kopi yang siap menyeduh, bercerita, dan membuatmu
            merasa di rumah.
          </p>

          <h3>Filosofi Kopi Kami</h3>
          <p>
            Kualitas, kesederhanaan, dan kebersamaan adalah tiga pilar utama
            dalam setiap cangkir kopi yang kami sajikan.
          </p>

          <h3>Suasana Padma</h3>
          <p>
            Kami menghadirkan ambience minimalis industrial yang nyaman untuk
            bekerja, bersantai, maupun berkumpul.
          </p>
        </div>

        <div class="section-right">
          <div class="cards">
            <div class="card">
              <img src="assets/images/image-2.jpg" alt="Padma Blend" />
              <h4>Padma Blend</h4>
              <p>
                Perpaduan biji pilihan dengan rasa, aroma, dan body yang
                seimbang.
              </p>
            </div>

            <div class="card">
              <img src="assets/images/image-1.jpeg" alt="Ambience Padma" />
              <h4>Ambience</h4>
              <p>Ambience tenang dan sejuk di Toko Kopi Padma.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- MENU -->
      <section id="menu" class="section container brews">
        <h2>Menu Kopi &amp; Kudapan</h2>
        <p class="muted">
          Nikmati racikan kopi spesial Padma dengan kudapan pilihan yang pas.
        </p>

        <div class="menu-grid">
  <?php
    // Ambil 4 menu terbaru
    $menuQuery = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC LIMIT 4");

    while ($m = mysqli_fetch_assoc($menuQuery)) {
  ?>

    <article class="menu-item">
      <h3><?= htmlspecialchars($m['name']) ?></h3>
      <p class="price">Rp<?= number_format($m['price'] / 1000) ?>K</p>

      <p class="desc">
        <?= htmlspecialchars($m['description']) ?>
      </p>
    </article>

  <?php } ?>
</div>

        <div class="hero-cta" style="text-align:center; margin-top:30px;">
          <a href="menu.php" class="btn">Lihat Menu Lengkap</a>
        </div>
      </section>

      <!-- GALERI -->
      <section id="galeri" class="section container gallery">
        <h2>Galeri Padma</h2>
        <p class="muted">
          Setiap cangkir punya cerita — potret hangat dari Toko Kopi Padma.
        </p>

        <div class="gallery-grid">
          <img src="assets/images/gallery-1.jpg" alt="gallery 1" />
          <img src="assets/images/gallery-2.jpg" alt="gallery 2" />
          <img src="assets/images/gallery-3.jpg" alt="gallery 3" />
          <img src="assets/images/gallery-4.jpg" alt="gallery 4" />
        </div>
      </section>

      <!-- LOKASI -->
      <section id="lokasi" class="section container lokasi">
        <div class="lokasi-grid">
          <div class="lokasi-info">
            <h2>Nikmati di Surabaya</h2>
            <p class="muted">Toko Kopi Padma hadir di Kota Surabaya.</p>
            <p class="alamat">
              📍 Jl. Tunjungan No.86-88, Genteng, Surabaya, Jawa Timur
            </p>
            <a class="btn" href="https://goo.gl/maps/xxxxx" target="_blank">Lihat Peta</a>
          </div>

          <div class="lokasi-img">
            <img src="assets/images/surabaya-image.jpeg" alt="Kota Surabaya" />
          </div>
        </div>
      </section>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer container">
      <p>
        &copy; <span id="year"></span> Toko Kopi Padma. Seduh · Nikmati · Ulangi.
      </p>
    </footer>

    <script>
      document.getElementById("year").textContent = new Date().getFullYear();
    </script>
  </body>
</html>