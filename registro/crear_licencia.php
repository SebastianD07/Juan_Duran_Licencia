<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();


function generarCodigoLicencia($longitud = 10) {
    $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $codigo;
}


$codigo_generado = generarCodigoLicencia();


if (isset($_POST['submit'])) {
    $id_licencia = $_POST['id_licencia'];
    $id_estado = $_POST['id_estado'];
    $tipo_licencia = $_POST['tipo_licencia'];
    $id_empresa = $_POST['id_empresa'];
    $fecha_ini_licencia = $_POST['fecha_ini_licencia'];
    $fecha_fin_licencia = $_POST['fecha_fin_licencia'];


    $verificar_estado = $conexion->prepare("SELECT COUNT(*) FROM estado_licencia WHERE id_estado_licencia = ?");
    $verificar_estado->execute([$id_estado]);


    if ($verificar_estado->fetchColumn() == 0) {
        echo '<script>alert("El estado seleccionado no es válido.");</script>';
        echo '<script>window.location = "crear_licencia.php";</script>';
        exit();
    }


    $sql1 = $conexion->prepare("SELECT * FROM licencia WHERE id_licencia = ?");
    $sql1->execute([$id_licencia]);
    $fila = $sql1->fetch(PDO::FETCH_ASSOC);


    if ($fila) {
        echo '<script>alert("Ya existe una licencia con este código");</script>';
        echo '<script>window.location = "crear_licencia.php";</script>';
        exit();
    }


    
    $insert = $conexion->prepare("INSERT INTO licencia (id_licencia, id_estado, tipo_licencia, id_empresa, fecha_ini_licencia, fecha_fin_licencia) 
                                            VALUES (?, ?, ?, ?, ?, ?)");


    if ($insert->execute([$id_licencia, $id_estado, $tipo_licencia, $id_empresa, $fecha_ini_licencia, $fecha_fin_licencia])) {
        echo '<script>alert("Licencia registrada exitosamente");</script>';
        echo '<script>window.location = "../super_administrador/super_administrador.php";</script>';
    } else {
        echo '<script>alert("Error al registrar la licencia");</script>';
        echo '<script>window.location = "crear_licencia.php";</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Licencia</title>
    <link rel="stylesheet" href="css/style_registro.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="wrapper">
    <div class="master">
        <img src="style/license.png" alt="">
    </div>
    <form method="POST" action="" autocomplete="off">
        <h1>Crear Licencia</h1>

        <div class="input-box">
            <input type="text" name="id_licencia" id="id_licencia" placeholder="Código de Licencia" required value="<?php echo $codigo_generado; ?>">
        </div>

        <div class="input-box">
            <select name="id_estado" required>
                <option value="">Seleccione el estado</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM estado_licencia");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_estado_licencia'] . "'>" . $fila['nom_estado'] . "</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="input-box">
            <label for="tipo_licencia">Tipo de Licencia:</label>
            <select name="tipo_licencia" id="tipo_licencia" required onchange="actualizarFechas()">
                <option value="">Seleccione el tipo de licencia</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM tipo_licencia");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_tipo_licencia'] . "' data-duracion='" . $fila['duracion_licencia'] . "'>" .
                    $fila['nom_tipo_licencia'] . " - Valor: " . $fila['valor'] . "</option>";
                }
                ?>
            </select>
        </div>
        



        <div class="input-box">
            <select name="id_empresa" required>
                <option value="">Seleccione la empresa</option>
                <?php
                $sql = $conexion->prepare("SELECT * FROM empre_licencia");
                $sql->execute();
                while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fila['id_empresa'] . "'>" . $fila['nom_empresa'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="input-box">
            <label for="fecha_ini_licencia">Fecha de inicio:</label>
            <input type="date" name="fecha_ini_licencia" id="fecha_ini_licencia" required>
        </div>

        <div class="input-box">
            <label for="fecha_fin_licencia">Fecha de fin:</label>
            <input type="date" name="fecha_fin_licencia" id="fecha_fin_licencia" required>
        </div>

        <button type="submit" name="submit" id="submit" class="btn">Registrar Licencia</button>
    </form>
</div>

<script>
function actualizarFechas() {
    const select = document.getElementById("tipo_licencia");
    const selectedOption = select.options[select.selectedIndex];
    const duracionDias = parseInt(selectedOption.getAttribute("data-duracion"));

    if (isNaN(duracionDias)) {
        document.getElementById("fecha_ini_licencia").value = "";
        document.getElementById("fecha_fin_licencia").value = "";
        return;
    }

    const hoy = new Date();
    const fechaFin = new Date(hoy);
    fechaFin.setDate(fechaFin.getDate() + duracionDias);

    const formato = (fecha) => fecha.toISOString().split('T')[0];

    document.getElementById("fecha_ini_licencia").value = formato(hoy);
    document.getElementById("fecha_fin_licencia").value = formato(fechaFin);
}
</script>
</body>
</html>