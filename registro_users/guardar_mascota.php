<?php
session_start();
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_barras = $_POST['codigo_barras'];
    $nombre_mascota = $_POST['nombre_mascota'];
    $tipo_mascota = $_POST['tipo_mascota'];
    $raza_mascota = $_POST['raza_mascota'];

    $doc_user = $_POST['doc_user'];

    try {
        // Ajusta los nombres de columna si alguno está diferente en tu tabla real
        $sql = "INSERT INTO mascotas (codigo_barras, nombre_mascota, tipo_mascota, raza_mascota, doc_user)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            $codigo_barras,
            $nombre_mascota,
            $tipo_mascota,
            $raza_mascota,
            $doc_user
        
        ]);

        // Redirecciona con mensaje de éxito
        header("Location: codigo_barras.php?mensaje=Mascota guardada correctamente");
        exit();
    } catch (PDOException $e) {
        echo "Error al guardar la mascota: " . $e->getMessage();
    }
} 
?> 