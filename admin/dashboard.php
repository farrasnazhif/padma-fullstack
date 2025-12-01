<?php
session_start();
include "../config/db.php";
if (!isset($_SESSION['admin'])) header("Location: login.php");

$menu = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC");
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">

<h3>Dashboard Admin</h3>
<a href="logout.php" class="btn btn-danger float-end">Logout</a>

<hr>
<h4>Tambah Menu Baru</h4>

<form action="add_menu.php" method="POST" enctype="multipart/form-data">
  <input name="name" class="form-control mb-2" placeholder="Nama">
  <input name="category" class="form-control mb-2" placeholder="Kategori">
  <input name="price" class="form-control mb-2" placeholder="Harga">
  <textarea name="description" class="form-control mb-2"></textarea>
  <input type="file" name="image" class="form-control mb-2">
  <button class="btn btn-success">Tambah</button>
</form>

<hr>
<h4>Daftar Menu</h4>
<table class="table">
<tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr>
<?php while($m = mysqli_fetch_assoc($menu)) { ?>
<tr>
  <td><?= $m['name'] ?></td>
  <td><?= $m['category'] ?></td>
  <td>Rp <?= number_format($m['price']) ?></td>
  <td>
    <a href="edit_menu.php?id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="delete_menu.php?id=<?= $m['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
  </td>
</tr>
<?php } ?>
</table>

<hr>
<h4>Daftar Pesanan</h4>
<?php while($o = mysqli_fetch_assoc($orders)) { ?>
  <div class="card p-3 mb-2">
    <strong>#<?= $o['queue_number'] ?> - <?= $o['customer_name'] ?></strong>
    <p>Total: Rp <?= number_format($o['total_price']) ?></p>
  </div>
<?php } ?>

</div>

</body>
</html>