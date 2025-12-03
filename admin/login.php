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
        exit;
    } else {
        $error = "Email atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin — Kopi Padma</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;600;800&display=swap"
    rel="stylesheet"
  >

  <style>
    :root {
      --bg: #f2f2f2;
      --accent: #111;
      --muted: #6a6a6a;
      --radius: 12px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: "Inter", sans-serif;
      background: var(--bg);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* LOGIN CARD */
    .login-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      padding: 40px 32px;
      border-radius: var(--radius);
      box-shadow: 0 6px 24px rgba(0,0,0,0.08);
      animation: fadeIn 0.5s ease;
    }

    .login-card h2 {
      font-family: "Playfair Display", serif;
      font-size: 32px;
      margin-bottom: 4px;
      text-align: center;
    }

    .login-card p.subtitle {
      text-align: center;
      color: var(--muted);
      margin-bottom: 20px;
      font-size: 14px;
    }

    .login-card input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 14px;
      font-size: 14px;
    }

    .btn-login {
      width: 100%;
      background: #111;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 25px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 4px;
      transition: 0.2s ease;
    }

    .btn-login:hover {
      background: #333;
    }

    .error-box {
      background: #ffdddd;
      border-left: 4px solid #d32f2f;
      padding: 10px 12px;
      margin-bottom: 16px;
      border-radius: 6px;
      color: #a02727;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

</head>
<body>

<div class="login-card">

    <h2>Admin Login</h2>
    <p class="subtitle">Toko Kopi Padma</p>

    <?php if(isset($error)): ?>
        <div class="error-box"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="email" name="email" placeholder="Email admin" required>
      <input type="password" name="password" placeholder="Password" required>
      <button class="btn-login">Masuk</button>
    </form>

</div>

</body>
</html>