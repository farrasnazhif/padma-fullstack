<?php
session_start();
include "config/db.php";

$cart = $_SESSION['cart'] ?? [];
if (!$cart) header("Location: menu.php");

$total = 0;
foreach ($cart as $c) $total += $c['qty'] * $c['price'];

if ($_POST) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    $q = mysqli_query($conn, "SELECT COUNT(*) AS c FROM orders WHERE DATE(created_at)=CURDATE()");
    $queue = mysqli_fetch_assoc($q)['c'] + 1;

    mysqli_query($conn, "INSERT INTO orders(customer_name,phone,type,total_price,queue_number)
    VALUES('$name','$phone','$type','$total','$queue')");

    $order_id = mysqli_insert_id($conn);

    foreach ($cart as $id => $c) {
        mysqli_query($conn,
        "INSERT INTO order_items(order_id,menu_id,quantity,price)
        VALUES('$order_id','$id','".$c['qty']."','".$c['price']."')");
    }

    unset($_SESSION['cart']);

    header("Location: checkout_success.php?id=".$order_id);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
<h3>Checkout</h3>

<form method="post">
  <label>Nama</label>
  <input type="text" name="name" class="form-control mb-2" required>

  <label>Nomor WA</label>
  <input type="text" name="phone" class="form-control mb-2" required>

  <label>Takeaway / Dine-in</label>
  <select name="type" class="form-select mb-3">
    <option value="takeaway">Takeaway</option>
    <option value="dinein">Dine-in</option>
  </select>

  <h4>Total: Rp <?= number_format($total) ?></h4>

  <button class="btn btn-primary">Submit</button>
</form>

</div>
</body>
</html>