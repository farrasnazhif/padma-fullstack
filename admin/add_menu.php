<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_POST) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = intval($_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle upload gambar
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/img/" . $image);
    }

    $query = "INSERT INTO menu(name,category,description,price,image)
              VALUES('$name','$category','$description',$price,'$image')";

    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit;
}
?>