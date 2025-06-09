<?php
require_once("conexion.php"); 
$conexion = conect();

$query = "SELECT Id_destino, DESTINO_TURISTICO_nombre FROM DESTINO_TURISTICO";
$resultado = mysqli_query($conexion, $query);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<option value="' . $fila["Id_destino"] . '">' . htmlspecialchars($fila["DESTINO_TURISTICO_nombre"]) . '</option>';
    }
} else {
    echo '<option value="">No hay destinos disponibles</option>';
}

mysqli_close($conexion);
?>
