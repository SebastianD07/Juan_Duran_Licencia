<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

$accion = $_POST['accion'];
$documento = $_POST['documento'] ?? '';
$nombres = $_POST['nombres'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';

if ($accion == 'crear') {
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO users (documento, nombres, apellidos, email, password, telefono, direccion, id_rol) VALUES (?, ?, ?, ?, ?, ?, ?, 3)");
        $stmt->execute([$documento, $nombres, $apellidos, $email, $hashed, $telefono, $direccion]);
    }
} elseif ($accion == 'actualizar') {
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("UPDATE users SET nombres=?, apellidos=?, email=?, password=?, telefono=?, direccion=? WHERE documento=? AND id_rol=3");
        $stmt->execute([$nombres, $apellidos, $email, $hashed, $telefono, $direccion, $documento]);
    } else {
        $stmt = $conexion->prepare("UPDATE users SET nombres=?, apellidos=?, email=?, telefono=?, direccion=? WHERE documento=? AND id_rol=3");
        $stmt->execute([$nombres, $apellidos, $email, $telefono, $direccion, $documento]);
    }
} elseif ($accion == 'eliminar') {
    $stmt = $conexion->prepare("DELETE FROM users WHERE documento=? AND id_rol=3");
    $stmt->execute([$documento]);
}

header("Location: ../registro_users/usuarios_modulos.php");
exit();
