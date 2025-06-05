<?php
session_start();

$_SESSION = array(); // Limpia todas las variables de sesión
session_destroy();

// Redirigí a login sin mensajes previos
header("Location: ../index.php?vista=login");
exit();
?>