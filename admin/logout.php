<?php
session_start();

// hapus semua session admin
session_unset();
session_destroy();

// redirect ke halaman login
header("Location: login.php");
exit;
?>