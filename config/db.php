<?php
$host = "127.0.0.1";
$user = "root";
$pass = "root"; // default MAMP
$db   = "padma_db";
$port = 8889;   // MySQL port for MAMP

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>