<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$menu = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id");
$data = mysqli_fetch_assoc($menu);

if (!$data) {
    die("Menu tidak ditemukan");
}

if ($_POST) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = intval($_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Jika upload gambar baru
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/img/" . $image);
    } else {
        $image = $data['image']; // tetap pakai gambar lama
    }

    mysqli_query($conn, "
        UPDATE menu SET
            name='$name',
            category='$category',
            description='$description',
            price=$price,
            image='$image'
        WHERE id=$id
    ");

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
<h3>Edit Menu</h3>

<form method="POST" enctype="multipart/form-data">

  <label>Nama</label>
  <input type="text" name="name" class="form-control mb-2" value="<?= $data['name'] ?>">

  <label>Kategori</label>
  <input type="text" name="category" class="form-control mb-2" value="<?= $data['category'] ?>">

  <label>Harga</label>
  <input type="number" name="price" class="form-control mb-2" value="<?= $data['price'] ?>">

  <label>Deskripsi</label>
  <textarea name="description" class="form-control mb-2"><?= $data['description'] ?></textarea>

  <label>Gambar saat ini</label>
  <br>
  <img src="../assets/img/<?= $data['image'] ?>" width="150" class="mb-3">

  <input type="file" name="image" class="form-control mb-3">

  <button class="btn btn-primary">Update</button>
  <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

</form>

</div>

</body>
</html>