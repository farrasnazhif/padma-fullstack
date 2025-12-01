<?php
session_start();
include "config/db.php";

$query = mysqli_query($conn, "SELECT * FROM menu ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Menu - Kopi Padma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
  <h2>Menu Kami</h2>

  <div class="row">
    <?php while($m = mysqli_fetch_assoc($query)) { ?>
      <div class="col-md-4 mb-3">
        <div class="card">
          <img src="assets/img/<?= $m['image'] ?>" class="card-img-top">
          <div class="card-body">
            <h5><?= $m['name'] ?></h5>
            <p><?= $m['description'] ?></p>
            <strong>Rp <?= number_format($m['price']) ?></strong>
            <a href="add_to_cart.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-primary float-end">Add to Cart</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>