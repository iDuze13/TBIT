<?php
session_start();
session_unset();
require_once("conexion.php");


$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

$conexion = conect();

if (!$conexion) {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Error de conexión a la base de datos.</div>";
    header("Location: ../index.php?vista=login");
    exit();
}

// Usa sentencia preparada para mayor seguridad (evita SQL Injection)
$consulta = "SELECT idUSUARIO, USUARIO_nombre FROM usuario WHERE USUARIO_nombre = ? AND USUARIO_contrasenia = ?";
$stmt = $conexion->prepare($consulta);
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();

    // Guarda el ID del usuario en la sesión
    $_SESSION['usuario'] = $fila['idUSUARIO']; // ✅ esto es lo correcto

    // Opcional: si también querés guardar el nombre
    // $_SESSION['usuario_nombre'] = $fila['USUARIO_nombre'];

    header("Location: ../index.php?vista=menu");
    exit();
} else {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Usuario o contraseña incorrectos.</div>";
    header("Location: ../index.php?vista=login");
    exit();
}
