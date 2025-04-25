<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();
?>

<?php
if (isset($_POST['submit'])) {
    $id_empresa = $_POST['id_empresa']; 
    $nom_empresa = $_POST['nom_empresa'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    
    if ($id_empresa == "" || $nom_empresa == "" || $direccion == "" || $telefono == "" || $email == "") {
        echo '<script>alert("Todos los campos son obligatorios");</script>';
        echo '<script>window.location = "crear_empresa.php";</script>';
        exit();
    }

    
    $sql1 = $conexion->prepare("SELECT * FROM empre_licencia WHERE id_empresa = $id_empresa OR email = '$email'");
    $sql1->execute();
    $fila = $sql1->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        echo '<script>alert("Ya existe una empresa con este NIT o email");</script>';
        echo '<script>window.location = "crear_empresa.php";</script>';
        exit();
    }

    
    $insert = $conexion->prepare("INSERT INTO empre_licencia (id_empresa, nom_empresa, direccion, telefono, email) 
                                  VALUES ($id_empresa, '$nom_empresa', '$direccion', $telefono, '$email')");
    if ($insert->execute()) {
        echo '<script>alert("Empresa registrada exitosamente");</script>';
        echo '<script>window.location = "../super_administrador/super_administrador.php";</script>';
    } else {
        echo '<script>alert("Error al registrar la empresa");</script>';
        echo '<script>window.location = "crear_empresa.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Una Empresa</title>
    <link rel="stylesheet" href="css/style_registro.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body onload="form.id_empresa.focus()">
<div class="wrapper">
    <div class="master">
        <img src="style/company.png" alt="">
    </div>
    <form method="POST" action="" autocomplete="off" name="form">
        <h1>Registrar Empresa</h1>

        <div class="input-box">
            <input type="number" name="id_empresa" id="id_empresa" placeholder="NIT de la Empresa" required>
        </div>

        <div class="input-box">
            <input type="text" name="nom_empresa" id="nom_empresa" placeholder="Nombre de la Empresa" required>
        </div>

        <div class="input-box">
            <input type="text" name="direccion" id="direccion" placeholder="Dirección" required>
        </div>

        <div class="input-box">
            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" required>
        </div>

        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>

        <button type="submit" name="submit" id="submit" class="btn">Registrar Empresa</button>
    </form>
</div>
</body>
</html>