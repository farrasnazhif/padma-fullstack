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
<title>Keranjang — Toko Kopi Padma</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
  .cart-container {
    width: 90%;
    max-width: 900px;
    margin: 50px auto;
  }
  .cart-title {
    font-family: "Playfair Display", serif;
    font-size: 34px;
    margin-bottom: 20px;
  }
  table {
    width: 100%;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
  }
  th, td {
    padding: 14px;
    border-bottom: 1px solid #eee;
  }
  .qty-input {
    width: 70px;
    padding: 6px;
    border-radius: 6px;
    border: 1px solid #ccc;
    text-align: center;
  }
  .btn-update {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background: #111;
    color: white;
    border-radius: 25px;
    border: none;
    font-weight: 600;
    cursor: pointer;
  }

  .btn-delete-item {
  display: inline-block;
  background: #e63946;
  color: white;
  padding: 6px 12px;
  border-radius: 6px;
  font-weight: bold;
  text-decoration: none;
  font-size: 14px;
}

.btn-delete-item:hover {
  background: #c5303a;
}
</style>

</head>

<body>

<header class="site-header">
  <nav class="nav container">
    <img src="assets/logo/logo-icon.png" class="icon">
    <ul class="nav-links">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="menu.php">Menu</a></li>
    </ul>
  </nav>
</header>

<div class="cart-container">

  <h1 class="cart-title">Keranjang Belanja</h1>

<?php if (!$cart) { ?>
  <p>Keranjang kosong.</p>

<?php } else { ?>

<form action="update_cart.php" method="POST">

<table>
  <tr>
    <th>Menu</th>
    <th>Qty</th>
    <th>Subtotal</th>
  </tr>

  <?php foreach($cart as $id => $c) { ?>
  <tr>
  <td><?= $c['name'] ?></td>

  <td>
    <input type="number"
           class="qty-input"
           name="qty[<?= $id ?>]"
           value="<?= $c['qty'] ?>"
           min="1">
  </td>

  <td>Rp <?= number_format($c['price'] * $c['qty'], 0, ',', '.') ?></td>

  <td>
    <a href="remove_item.php?id=<?= $id ?>" class="btn-delete-item">×</a>
  </td>
</tr>
  <?php } ?>

</table>

<button type="submit" class="btn-update">Update Keranjang</button>
</form>

<h3>Total: Rp <?= number_format($total, 0, ',', '.') ?></h3>

<a href="checkout.php" class="btn-submit">Checkout</a>

<?php } ?>

</div>

</body>
</html>