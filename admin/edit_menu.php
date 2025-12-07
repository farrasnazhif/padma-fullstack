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

    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/img/" . $image);
    } else {
        $image = $data['image'];
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
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu | Kopi Padma</title>

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
      --radius: 12px;
    }

    body {
      margin: 0;
      background: var(--bg);
      font-family: "Inter", sans-serif;
      color: var(--accent);
    }

    .container {
      width: 92%;
      max-width: 900px;
      margin: 40px auto;
    }

    h2 {
      font-family: "Playfair Display", serif;
      font-size: 32px;
      margin-bottom: 10px;
    }

    .card {
      background: #fff;
      padding: 26px;
      border-radius: var(--radius);
      box-shadow: 0 6px 24px rgba(0,0,0,0.08);
      margin-top: 20px;
    }

    label {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 6px;
      display: block;
    }

    input, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 18px;
      font-size: 14px;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    img.preview {
      width: 160px;
      border-radius: 10px;
      margin-bottom: 16px;
      box-shadow: 0 4px 18px rgba(0,0,0,0.08);
    }

    .btn {
      padding: 10px 18px;
      border-radius: 25px;
      background: #111;
      color: #fff;
      border: none;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      margin-right: 6px;
      transition: 0.2s ease;
    }

    .btn:hover {
      background: #333;
    }

    .btn-secondary {
      background: #888;
    }

    .btn-secondary:hover {
      background: #666;
    }
  </style>
</head>

<body>

<div class="container">

  <h2>Edit Menu</h2>

  <div class="card">
    <form method="POST" enctype="multipart/form-data">

      <label>Nama Menu</label>
      <input type="text" name="name" value="<?= $data['name'] ?>" required>

      <label>Kategori</label>
      <input type="text" name="category" value="<?= $data['category'] ?>" required>

      <label>Harga</label>
      <input type="number" name="price" value="<?= $data['price'] ?>" required>

      <label>Deskripsi</label>
      <textarea name="description" required><?= $data['description'] ?></textarea>

      <label>Gambar Saat Ini</label>
      <img src="../assets/img/<?= $data['image'] ?>" class="preview">

      <label>Upload Gambar Baru</label>
      <input type="file" name="image">

      <button class="btn" type="submit">Simpan Perubahan</button>
      <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

    </form>
  </div>

</div>

</body>
</html>