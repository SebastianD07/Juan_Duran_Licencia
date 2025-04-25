<?php
session_start();
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();


if (!isset($_SESSION['email'])) {
    header("Location: ../login/login.php");
    exit();
}

$email = $_SESSION['email'];


$sql = $conexion->prepare("SELECT nombres, apellidos FROM users WHERE email = ? AND id_rol = 3");
$sql->execute([$email]);
$usuario = $sql->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo '<script>alert("No se encontró información del usuario.");</script>';
    echo '<script>window.location = "../login/login.php";</script>';
    exit();
}

$nombres = $usuario['nombres'];
$apellidos = $usuario['apellidos'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mascota = $_POST['id_mascota'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_salida = $_POST['fecha_salida'];

    if (!empty($id_mascota) && !empty($fecha_ingreso) && !empty($fecha_salida)) {
        $insert = $conexion->prepare("INSERT INTO ingreso_parque (id_mascota, fecha_ingreso, fecha_salida) VALUES (?, ?, ?)");
        $insert->execute([$id_mascota, $fecha_ingreso, $fecha_salida]);

        echo '<script>alert("Ingreso registrado correctamente.");</script>';
        echo '<script>window.location = "../usuario/usuario.php";</script>';
        exit();
    } else {
        echo '<script>alert("Todos los campos son obligatorios.");</script>';
    }
}


$sql_mascotas = $conexion->prepare("SELECT id_mascota, nombre_mascota FROM mascotas");
$sql_mascotas->execute();
$mascotas = $sql_mascotas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Usuario</title>
  <link rel="stylesheet" href="css/style_user.css">
</head>
<body>

  <div class="navbar">
    <h1>Bienvenido, <span><?php echo $nombres . ' ' . $apellidos; ?></span></h1>
    <form action="logout.php" method="POST">
      <button type="submit" class="logout-btn">Cerrar sesión</button>
    </form>
  </div>

  <div class="content">
    <p>Este es tu panel de usuario. Desde aquí puedes gestionar tus accesos y registrar ingresos al parque.</p>

    <form method="POST">
      <h2 style="margin-bottom: 1rem;">Registrar Ingreso de Mascota</h2>

      <label for="id_mascota">Seleccionar Mascota</label>
      <select name="id_mascota" required>
        <option value="">-- Selecciona una mascota --</option>
        <?php foreach ($mascotas as $mascota): ?>
          <option value="<?php echo $mascota['id_mascota']; ?>">
            <?php echo $mascota['nombre_mascota']; ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="fecha_ingreso">Fecha de Ingreso</label>
      <input type="datetime-local" name="fecha_ingreso" value="<?php echo date('Y-m-d\TH:i'); ?>" required>

      <label for="fecha_salida">Fecha de Salida</label>
      <input type="datetime-local" name="fecha_salida" value="<?php echo date('Y-m-d\TH:i'); ?>" required>

      <button type="submit" class="btn-submit">Registrar Ingreso</button>
    </form>
  </div>

</body>
</html>
