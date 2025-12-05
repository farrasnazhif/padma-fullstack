<?php
session_start();
include "../config/db.php";
if (!isset($_SESSION['admin'])) header("Location: login.php");

$menu = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC");
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard Admin — Kopi Padma</title>
    <link rel="icon" type="image/png" href="../assets/logo/logoheader.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600;800&display=swap"
    rel="stylesheet">

  <style>
    :root {
      --bg: #f2f2f2;
      --accent: #111;
      --muted: #6a6a6a;
      --card-bg: #fff;
      --radius: 12px;
    }

    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background: var(--bg);
      color: var(--accent);
    }

    .container {
      width: 92%;
      max-width: 1100px;
      margin: 30px auto;
    }

    /* HEADER */
    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .admin-header h2 {
      font-family: "Playfair Display", serif;
      font-size: 34px;
      margin: 0;
    }

    .btn-logout {
      padding: 10px 16px;
      border-radius: 25px;
      background: #c62828;
      color: #fff;
      text-decoration: none;
      font-size: 14px;
    }

    .btn-logout:hover {
      background: #a11919;
    }

    /* SECTION TITLE */
    h3 {
      font-size: 22px;
      margin-top: 40px;
      margin-bottom: 12px;
      font-family: "Playfair Display", serif;
    }

    /* CARD FORM */
    .card {
      background: var(--card-bg);
      padding: 20px;
      border-radius: var(--radius);
      box-shadow: 0 4px 18px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px 14px;
      margin-bottom: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .btn {
      padding: 10px 16px;
      border-radius: 25px;
      background: #111;
      color: white;
      text-decoration: none;
      border: none;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
    }

    .btn:hover {
      background: #333;
    }

    /* TABLE */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 12px;
      background: #fff;
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(0,0,0,0.05);
    }

    table th, table td {
      padding: 14px;
      font-size: 14px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    table th {
      background: #fafafa;
      font-weight: 600;
    }

    table tr:hover {
      background: #f8f8f8;
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 20px;
      text-decoration: none;
      color: white;
    }

    .btn-edit { background: #ffb300; }
    .btn-edit:hover { background: #d99800; }

    .btn-delete { background: #d32f2f; }
    .btn-delete:hover { background: #b52020; }

    /* ORDER CARDS */
    .order-card {
      background: #fff;
      padding: 14px 18px;
      border-radius: var(--radius);
      box-shadow: 0 4px 18px rgba(0,0,0,0.05);
      margin-bottom: 12px;
    }

    .order-card strong {
      font-size: 16px;
    }

    @media (max-width: 600px) {
      table th, table td { font-size: 12px; }
    }
  </style>
</head>

<body>

<div class="container">

  <!-- HEADER -->
  <div class="admin-header">
    <h2>Dashboard Admin</h2>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>

  <!-- ADD MENU -->
  <h3>Tambah Menu Baru</h3>
  <div class="card">
    <form action="add_menu.php" method="POST" enctype="multipart/form-data">
      <input name="name" placeholder="Nama Menu" required>
      <input name="category" placeholder="Kategori" required>
      <input name="price" type="number" placeholder="Harga" required>
      <textarea name="description" placeholder="Deskripsi menu" required></textarea>
      <input type="file" name="image" required>
      <button class="btn">Tambah Menu</button>
    </form>
  </div>

  <!-- MENU LIST -->
  <h3>Daftar Menu</h3>
  <table>
    <tr>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Aksi</th>
    </tr>

    <?php while($m = mysqli_fetch_assoc($menu)) { ?>
    <tr>
      <td><?= $m['name'] ?></td>
      <td><?= $m['category'] ?></td>
      <td>Rp <?= number_format($m['price'], 0, ',', '.') ?></td>
      <td>
        <a href="edit_menu.php?id=<?= $m['id'] ?>" class="btn-sm btn-edit">Edit</a>
        <a href="delete_menu.php?id=<?= $m['id'] ?>" class="btn-sm btn-delete">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>

  <!-- ORDER LIST -->
  <h3>Daftar Pesanan</h3>

<?php while($o = mysqli_fetch_assoc($orders)) { ?>
  <div class="order-card">
      <strong>#<?= $o['queue_number'] ?> — <?= $o['customer_name'] ?></strong>
      <p>Total: Rp <?= number_format($o['total_price'], 0, ',', '.') ?></p>

      <a href="delete_order.php?id=<?= $o['id'] ?>"
         class="btn-sm btn-delete"
         onclick="return confirm('Yakin ingin menghapus pesanan ini?')">
         Delete
      </a>
  </div>
<?php } ?>

</div>

</body>
</html>