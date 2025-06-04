<?php
session_start();
require_once("conexion.php");

$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

$conexion = conect();

if (!$conexion) {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Error de conexión a la base de datos.</div>";
    header("Location: ../index.php?vista=login");
    exit();
}

$consulta = "SELECT * FROM usuario WHERE USUARIO_nombre ='$usuario' AND USUARIO_contrasenia='$contrasena'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) == 1) {
    $_SESSION['usuario'] = $usuario;
    header("Location: ../index.php?vista=menu");
    exit();
} else {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Usuario o contraseña incorrectos.</div>";
    header("Location: ../index.php?vista=login");
    exit();
}
