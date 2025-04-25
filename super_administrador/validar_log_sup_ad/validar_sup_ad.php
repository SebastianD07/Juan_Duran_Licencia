<?php
session_start();
require_once('..//../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' || $password == '') {
        echo '<script>alert("Ningún dato puede estar vacío")</script>';
        echo '<script>window.location = "../super_administrador/login_super_admin.php"</script>';
        exit();
    }

    $sql = $conexion->prepare("SELECT * FROM users WHERE email = '$email'");
    $sql->execute();
    $fila = $sql->fetch(PDO::FETCH_ASSOC);

    if ($fila) {
        if (password_verify($password, $fila['password'])) {
            $_SESSION['email'] = $fila['email'];
            $_SESSION['nom_rol'] = $fila['id_rol'];

            if ($_SESSION['nom_rol'] == 1) {
                header("location: ../super_administrador.php");
                exit();
            }

        } else {
            echo '<script>alert("Credenciales incorrectas")</script>';
            echo '<script>window.location = "../super_administrador/login_super_admin.php"</script>';
            exit();
        }
    } else {
        echo '<script>alert("Usuario no encontrado")</script>';
        echo '<script>window.location = "../super_administrador/login_super_admin.php"</script>';
        exit();
    }
}
?>