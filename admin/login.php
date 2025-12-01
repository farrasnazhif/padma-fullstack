<?php
session_start();
include "../config/db.php";

if ($_POST) {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $q = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    $a = mysqli_fetch_assoc($q);

    if ($a && password_verify($pass, $a['password'])) {
        $_SESSION["admin"] = $a['id'];
        header("Location: dashboard.php");
    } else {
        $error = "Email atau password salah";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
<h3>Admin Login</h3>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="post">
  <input type="email" name="email" class="form-control mb-2" placeholder="Email">
  <input type="password" name="password" class="form-control mb-2" placeholder="Password">
  <button class="btn btn-primary">Login</button>
</form>

</div>

</body>
</html>