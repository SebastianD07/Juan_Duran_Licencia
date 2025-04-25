<?php
    session_start();
    require_once('../conexion/conexion.php');
    $conexion = new database();
    $conexion = $conexion->conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Super Administrador</title>
  <link rel="stylesheet" href="css/style_login_super_ad.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

  <div class="wrapper">
    
  <form method="POST"action="../super_administrador/validar_log_sup_ad/validar_sup_ad.php" autocomplete="off">

      <h1>Login Super Administrador</h1>

      <div class="input-box">
        <input type="text" name="email" id="email" placeholder="Email" required>
        <i class='bx bxs-user'></i>
      </div>

      <div class="input-box">
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>

      <button type="submit" name="register" id="register" class="btn">Login</button>

    </form>

  </div>
</body>
</html>

