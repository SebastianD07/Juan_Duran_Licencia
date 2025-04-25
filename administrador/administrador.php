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


$sql = $conexion->prepare("SELECT users.nombres, users.apellidos, empre_licencia.nom_empresa, empre_licencia.id_empresa FROM users INNER JOIN rol ON users.id_rol = rol.id_rol INNER JOIN empre_licencia ON users.id_empresa = empre_licencia.id_empresa WHERE users.email = ? AND users.id_rol = 2
");
$sql->execute([$email]);
$fila = $sql->fetch(PDO::FETCH_ASSOC);


if (!$fila) {
    echo '<script>alert("No se encontró información del administrador.");</script>';
    echo '<script>window.location = "../login/login.php";</script>';
    exit();
}


$nombres = $fila['nombres'];
$apellidos = $fila['apellidos'];
$empresa = $fila['nom_empresa'];
$nit = $fila['id_empresa'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_adminis.css">
</head>
<body>
    <div class="navbar">
        <div class="admin-name">👤 Administrador: <?php echo $nombres . " " . $apellidos; ?></div>
        <div class="admin-empre">🏢 Empresa: <?php echo $empresa; ?></div>
        <div class="admin-nit">📄 NIT: <?php echo $nit; ?></div>
        <a href="../validar/salir.php">
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
        </a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>¡Bienvenido al Panel de Administrador!</h1>
            <p class="welcome-msg">Gestiona Usuarios y Códigos de Barras desde aquí.</p>

            <div class="grid-panel">
                <a href="../registro_users/usuarios_modulos.php" class="card-link">
                    <div class="card">
                        <i class="fas fa-user-plus"></i> 
                        <span>Crear Usuarios</span>
                    </div>
                </a>

                <a href="../registro_users/codigo_barras.php" class="card-link">
                    <div class="card">
                        <i class="fas fa-barcode"></i> 
                        <span>Códigos de Barras</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
