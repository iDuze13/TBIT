<?php
session_start();
require_once("conexion.php");

$conn = conect();
$usuario = $_SESSION['usuario'] ?? 1; // Ajustá esto según tu sistema real de sesiones

$sql = "
SELECT 
    f.idFAVORITO,
    dt.Id_destino,
    dt.DESTINO_TURISTICO_nombre,
    dt.DESTINO_TURISTICO_descripcion,
    dt.DESTINO_TURISTICO_popularidad,
    dt.DESTINO_TURISTICO_tipo_destino
FROM favorito f
JOIN destino_turistico dt ON f.DESTINO_TURISTICO_nombre_destino = dt.Id_destino
WHERE f.USUARIO_idUSUARIO = $usuario_id
";
$resultado = mysqli_query($conn, $sql);
?>

