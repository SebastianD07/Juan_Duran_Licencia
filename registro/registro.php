<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();
$id_rol = 2; 
?>

<?php
if (isset($_POST['submit'])) {
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $id_empresa = $_POST['id_empresa'];

    echo $documento, $nombres, $apellidos, $email, $password, $telefono, $direccion, $id_empresa, $id_rol;

    $passw_enc = password_hash($password, PASSWORD_DEFAULT, array("cost" => 12));

    
    $sql1 = $conexion->prepare("SELECT * FROM users WHERE documento = $documento");
    $sql1->execute();
    $fila = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($fila) {
        echo '<script>alert("Ya existe un usuario con este documento");</script>';
        echo '<script>window.location = "registro.php";</script>';
    }


    if ($documento == "" || $nombres == "" || $apellidos == "" || $email == "" || $password == "" || $telefono == "" || $direccion == "" || $id_empresa == "" || $id_rol == "") {
        echo '<script>alert("Todos los campos son obligatorios");</script>';
        echo '<script>window.location = "registro.php";</script>';
    } else {

        $insert = $conexion->prepare("INSERT INTO users (documento, nombres, apellidos, email, password, telefono, direccion, id_empresa, id_rol) 
            VALUES ($documento, '$nombres', '$apellidos', '$email', '$passw_enc', $telefono, '$direccion', $id_empresa, 2)");
        $insert->execute();
        echo '<script>alert("Registro guardado exitosamente");</script>';
        echo '<script>window.location = "../super_administrador/super_administrador.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Un Administrador</title>
    <link rel="stylesheet" href="css/style_registro.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body onload="form.documento.focus()">
<div class="wrapper">
        <div class="master">
            <img src="style/chief.png" alt="">
        </div>
        <form method= "POST" action="" autocomplete="off" name="form">
            
                <h1>Registrar Administrador</h1>

                <div class="input-box">
                    <input type="number" name="documento" id="documento" placeholder="Documento" required >
                </div>

                <div class="input-box">
                    <input type="text" name="nombres" id="nombres" placeholder="Nombres" required>
                </div>

                <div class="input-box">
                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
                </div>

                <div class="input-box">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>

                <div class="input-box">
                    <input type="password" name= "password" id="password" placeholder="Password" required>
                </div>

                <div class="input-box">
                    <input type="number" name="telefono" id="telefono" placeholder="Telefono" required>
                </div>

                <div class="input-box">
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion" required>
                </div>

                <div class="input-box">
                    <select name="id_empresa">
                            <option value="">Seleccione la empresa</option>
                            <?php
                                $sql = $conexion->prepare("SELECT * FROM empre_licencia WHERE id_empresa >1");
                                $sql->execute();
                                while ($fila=$sql->fetch(PDO::FETCH_ASSOC)) {
                                    echo  "<option value=" . $fila['id_empresa']. ">" . $fila['nom_empresa'] ." </option>";
                                }
                            ?>
                    </select>
                </div>
                <button type="submit" name="submit" id="submit" class="btn">Registrar Administrador</button>
            </form>
    </div>
</body>
</html>