<?php
include "../config/db.php";

// set admin default
$admin_email = "admin@padma.test";
$admin_password = "admin123"; 
$admin_name = "Administrator";

// hash password sebelum disimpan ke db
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// cek apakah admin sudah ada
$check = mysqli_query($conn, "SELECT * FROM admin WHERE email='$admin_email'");
if (mysqli_num_rows($check) > 0) {
    echo "<h3>Admin sudah ada.</h3>";
    echo "Email: <strong>$admin_email</strong><br>";
    echo "Password: <strong>$admin_password</strong><br><br>";
    echo "Silakan login di <a href='login.php'>login.php</a>";
    exit;
}

// insert admin baru
$q = mysqli_query($conn, "
    INSERT INTO admin(email, password, name)
    VALUES('$admin_email', '$hashed_password', '$admin_name')
");

if ($q) {
    echo "<h3>Admin berhasil dibuat!</h3>";
    echo "Email: <strong>$admin_email</strong><br>";
    echo "Password: <strong>$admin_password</strong><br><br>";
    echo "Silakan login di <a href='login.php'>login.php</a><br><br>";
    echo "<span style='color:red;'>⚠️ Hapus file create_admin.php setelah selesai!</span>";
} else {
    echo "Gagal membuat admin: " . mysqli_error($conn);
}
?>