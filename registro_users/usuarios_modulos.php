<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();

if (!isset($_SESSION['email'])) {
    echo '<script>alert("Debe iniciar sesión para acceder a esta página.");</script>';
    echo '<script>window.location = "../login.php";</script>';
    exit();
}

$email = $_SESSION['email'];
$sql = $conexion->prepare("SELECT nombres, apellidos FROM users WHERE email = ? AND id_rol = 2");
$sql->execute([$email]);
$admin = $sql->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    echo '<script>alert("Acceso denegado.");</script>';
    echo '<script>window.location = "../login.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo Usuarios</title>
    <link rel="stylesheet" href="css/style_modulo_users.css">
</head>
<body>
    <div class="navbar">
        <div class="admin-name">👤 Administrador: <?php echo $admin['nombres'] . ' ' . $admin['apellidos']; ?></div>
        <a href="../validar/salir.php">
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
        </a>
    </div>

    <div class="user-module">
        <h2>Gestión de Usuarios </h2>

        <form action="../registro_users/procesar_estado.php" method="POST">
            <input type="text" name="documento" placeholder="Documento" required>
            <input type="text" name="nombres" placeholder="Nombres" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña (solo para crear o cambiar)">
            <input type="text" name="telefono" placeholder="Teléfono" required>
            <input type="text" name="direccion" placeholder="Dirección" required>
            <div class="form-buttons">
                <button type="submit" name="accion" value="crear">Crear Usuario</button>
                <button type="submit" name="accion" value="actualizar">Actualizar Usuario</button>
            </div>
        </form>

        <h3>Usuarios registrados </h3>
        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conexion->prepare("SELECT documento, nombres, apellidos, email, telefono, direccion FROM users WHERE id_rol = 3");
                $stmt->execute();
                while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$user['documento']}</td>
                            <td>{$user['nombres']} {$user['apellidos']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['telefono']}</td>
                            <td>{$user['direccion']}</td>
                            <td>
                                <form action='../registro_users/procesar_estado.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='documento' value='{$user['documento']}'>
                                    <button type='submit' name='accion' value='eliminar' onclick=\"return confirm('¿Eliminar este usuario?');\">Eliminar</button>
                                </form>
                            </td>
                          </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </body>
            </html>
