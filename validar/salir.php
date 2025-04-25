<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['nom_rol']);
session_destroy();
session_write_close();

header("Location: ../login/login.php");
exit();
?>
