<?php
session_start();
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();


$codigo_barras = time() . rand(4, max: 12); // Ejemplo: 1713988800123


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
    <title>Registrar Procesador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style_codigo_barras.css">
</head>
<body>
<div class="navbar">
        <div class="admin-name">👤 Administrador: <?php echo $admin['nombres'] . ' ' . $admin['apellidos']; ?></div>
        <a href="../validar/salir.php">
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
        </a>
    </div>
    <div class="container">
        <div class="form-section">
            <form action="guardar_mascota.php" method="POST">
                <label>Código de Barras:</label>
                <input type="text" name="codigo_barras" value="<?php echo $codigo_barras; ?>" readonly>

            <label>Nombre Mascota:</label>
            <input type="text" name="nombre_mascota" required>

            <div class="input-box">
                <label for="tipo_mascota">Mascota</label>
                <select name="tipo_mascota" required>
                    <option value="">Seleccione el tipo de mascota</option>
                    <?php
                    $sql = $conexion->prepare("SELECT id_tipo_mascota, nom_tipo_mascota FROM tipo_mascota");
                    $sql->execute();
                    while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['id_tipo_mascota'] . "'>" . $fila['nom_tipo_mascota'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-box">
                <label for="raza_mascota">Raza</label>
                <select name="raza_mascota" required>
                    <option value="">Seleccione la raza de la mascota</option>
                    <?php
                    $sql = $conexion->prepare("SELECT id_raza_mascota, nom_raza_mascota FROM raza_mascota");
                    $sql->execute();
                    while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['id_raza_mascota'] . "'>" . $fila['nom_raza_mascota'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="input-box">
                <label for="doc_user">Documento del Usuario</label>
                <select name="doc_user" required>
                    <option value="">Seleccione el documento del usuario</option>
                    <?php
                    $sql = $conexion->prepare("SELECT documento, nombres FROM users WHERE id_rol = 3");
                    $sql->execute();
                    while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $fila['documento'] . "'>" . $fila['nombres'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">Guardar Mascota</button>
        </form>
    </div>

    <div class="barcode-section">
        <h3>Código Generado</h3>
        <div id="barcode-img">
            <img src="/sistema_mascotas/registro_users/barcode.php?text=<?php echo $codigo_barras; ?>" alt="Código de Barras">
        </div>
        <div class="barcode-buttons">
            <button onclick="window.print()">Imprimir</button>
            <button onclick="downloadBarcode()">Descargar</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadBarcode() {
        html2canvas(document.querySelector('#barcode-img')).then(canvas => {
            const link = document.createElement('a');
            link.download = 'codigo_barras_<?php echo $codigo_barras; ?>.png';
            link.href = canvas.toDataURL();
            link.click();
        });
    }
</script>

</body>
</html>