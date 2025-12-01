<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cart - Kopi Padma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
<h3>Keranjang</h3>

<?php if (!$cart) { ?>
  <div class="alert alert-warning">Keranjang kosong.</div>
<?php } else { ?>

<table class="table">
  <tr><th>Menu</th><th>Qty</th><th>Harga</th></tr>
  <?php foreach($cart as $id => $c) { ?>
    <tr>
      <td><?= $c['name'] ?></td>
      <td><?= $c['qty'] ?></td>
      <td>Rp <?= number_format($c['price']*$c['qty']) ?></td>
    </tr>
  <?php } ?>
</table>

<h4>Total: Rp <?= number_format($total) ?></h4>
<a href="checkout.php" class="btn btn-success">Checkout</a>

<?php } ?>

</div>
</body>
</html>