<?php

require_once 'conexion.php';

$conexion = conect();

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}


$usuario_id = $_SESSION['usuario'] ?? null;

if (!$usuario_id) {
    $resultado = null;
    return;
}


$sql = "
SELECT
    f.idFAVORITO,
    f.DESTINO_TURISTICO_nombre_destino,
    f.USUARIO_idUSUARIO,
    dt.Id_destino,
    dt.DESTINO_TURISTICO_nombre,
    dt.DESTINO_TURISTICO_descripcion,
    dt.DESTINO_TURISTICO_popularidad,
    dt.DESTINO_TURISTICO_tipo_destino
FROM favorito f
JOIN destino_turistico dt ON f.DESTINO_TURISTICO_nombre_destino = dt.Id_destino
WHERE f.USUARIO_idUSUARIO = $usuario_id
";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    echo "<p><strong>Error en la consulta:</strong> " . mysqli_error($conexion) . "</p>";
    exit();
}
?>