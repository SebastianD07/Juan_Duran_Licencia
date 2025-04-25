<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();

if (!isset($_SESSION['email'])) {
  echo '<script>alert("Debe iniciar sesión para acceder a esta página.");</script>';
  echo '<script>window.location = "../login/login.php";</script>';
  exit();
}

$email = $_SESSION['email'];


$sql = $conexion->prepare("SELECT nombres, apellidos FROM users WHERE email = ? AND id_rol = 1");
$sql->execute([$email]);
$fila = $sql->fetch(PDO::FETCH_ASSOC);

if (!$fila) {
  echo '<script>alert("No se encontró información del administrador.");</script>';
  echo '<script>window.location = "../login/login.php";</script>';
  exit();
}

$nombres = $fila['nombres'];
$apellidos = $fila['apellidos'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Panel Super Administrador</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style_super_ad.css" /> 
</head>
<body>
  <div class="navbar">
  <div class="admin-name">👤 Super Administrador: <?php echo $nombres . " " . $apellidos; ?></div>
    <a href="validar_log_sup_ad/salir.php" class="logout-link">
      <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </a>
  </div>

  <div class="main-content">
    <div class="container">
      <h1>¡Bienvenido al Panel de Control!</h1>
      <p class="welcome-msg">Gestiona administradores, empresas y licencias desde aquí.</p>

      <div class="grid-panel">
        <a href="../registro/registro.php" class="card-link">
          <div class="card">
            <i class="fas fa-user-plus"></i>
            <span>Crear Administrador</span>
          </div>
        </a>
        <a href="../registro/crear_empresa.php" class="card-link">
          <div class="card">
            <i class="fas fa-building"></i>
            <span>Crear Empresa</span>
          </div>
        </a>
        <a href="../registro/crear_licencia.php" class="card-link">
          <div class="card">
            <i class="fas fa-certificate"></i>
            <span>Crear Licencia</span>
          </div>
        </a>
        <a href="../registro/registro_licencias.php" class="card-link">
          <div class="card">
            <i class="fas fa-clipboard-list"></i>
            <span>Registro de Licencias</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</body>
</html>
