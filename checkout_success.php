<?php
include "config/db.php";
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM orders WHERE id=$id");
$o = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pesanan Sukses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
<h3>Pesanan Berhasil Dibuat!</h3>
<h4>Nomor Antrean: #<?= $o['queue_number'] ?></h4>
<p>Nama: <?= $o['customer_name'] ?></p>
<p>WA: <?= $o['phone'] ?></p>

<a href="index.php" class="btn btn-primary">Kembali ke Home</a>
</div>

</body>
</html>