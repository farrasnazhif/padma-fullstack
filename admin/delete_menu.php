<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT image FROM menu WHERE id=$id");
$data = mysqli_fetch_assoc($query);

// hapus file gambar jika ada
if ($data && !empty($data['image'])) {
    $imagePath = "../assets/img/" . $data['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

mysqli_query($conn, "DELETE FROM menu WHERE id=$id");

header("Location: dashboard.php");
exit;
?>