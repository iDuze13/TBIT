<?php
session_start();
require_once("conexion.php");

$cuil = $_POST['cuil'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
$nacionalidad = $_POST['nacionalidad'] ?? '';
$correo = $_POST['correo'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

if (empty($cuil) || empty($nombre) || empty($apellido) || empty($fecha_nacimiento) || empty($nacionalidad) || empty($correo) || empty($usuario) || empty($contrasena)) {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Todos los campos son obligatorios.</div>";
    header("Location: ../index.php?vista=registro");
    exit();
}

$conexion = conect();

if (!$conexion) {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Error de conexión a la base de datos.</div>";
    header("Location: ../index.php?vista=registro");
    exit();
}

// 1. Insertar persona
$consulta_persona = "INSERT INTO persona (CUIL, PERSONA_nombre, PERSONA_apellido, PERSONA_fecha_N, PERSONA_nacionalidad, PERSONA_correo) 
                     VALUES ('$cuil', '$nombre', '$apellido', '$fecha_nacimiento', '$nacionalidad', '$correo')";

$resultado_persona = mysqli_query($conexion, $consulta_persona);

if ($resultado_persona) {
    // 2. Obtener el ID de la persona insertada
    $idPersona = mysqli_insert_id($conexion); // ← Este es el ID autogenerado

    // 3. Insertar usuario asociado a persona
    $consulta_usuario = "INSERT INTO usuario (USUARIO_nombre, USUARIO_contrasenia, PERSONA_ID_PERSONA)
                         VALUES ('$usuario', '$contrasena', '$idPersona')";

    $resultado_usuario = mysqli_query($conexion, $consulta_usuario);

    if ($resultado_usuario) {
        $_SESSION['mensaje'] = "<div class='notification is-success'>Registro exitoso.</div>";
        header("Location: ../index.php?vista=login");
        exit();
    } else {
        $_SESSION['mensaje'] = "<div class='notification is-danger'>Error al registrar el usuario.</div>";
        header("Location: ../index.php?vista=registro");
        exit();
    }

} else {
    $_SESSION['mensaje'] = "<div class='notification is-danger'>Error al registrar la persona.</div>";
    header("Location: ../index.php?vista=registro");
    exit();
}
?>
