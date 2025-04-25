<?php
require_once('../conexion/conexion.php');
$conexion = new database();
$conexion = $conexion->conectar();
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro de Licencias</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style_regis_lice.css" />
</head>
<body>
  <div class="wrapper">
    <h1>Registro de Licencias</h1>
    <table>
      <thead>
        <tr>
          <th>Código Licencia</th>
          <th>Empresa</th>
          <th>NIT Empresa</th>
          <th>Estado</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = $conexion->prepare("SELECT 
                licencia.id_licencia, 
                empre_licencia.nom_empresa, 
                empre_licencia.id_empresa,
                estado_licencia.nom_estado, 
                licencia.fecha_ini_licencia, 
                licencia.fecha_fin_licencia
            FROM licencia
            INNER JOIN empre_licencia ON licencia.id_empresa = empre_licencia.id_empresa
            INNER JOIN estado_licencia ON licencia.id_estado = estado_licencia.id_estado_licencia
        ");
        $sql->execute();

        while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $fila['id_licencia'] . "</td>";
            echo "<td>" . $fila['nom_empresa'] . "</td>";
            echo "<td>" . $fila['id_empresa'] . "</td>";
            echo "<td>" . $fila['nom_estado'] . "</td>";
            echo "<td>" . $fila['fecha_ini_licencia'] . "</td>";
            echo "<td>" . $fila['fecha_fin_licencia'] . "</td>";
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
