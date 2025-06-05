<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // o tu contraseña
$basededatos = "destinosturisticos";

$conn = new mysqli($host, $usuario, $contrasena, $basededatos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener mes y año seleccionados
$mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');
$anio = isset($_GET['anio']) ? $_GET['anio'] : date('Y');

// Consulta de ranking por promedio de puntaje
$sql = "
SELECT 
    dt.DESTINO_TURISTICO_nombre AS destino,
    p.PROVINCIA_nombre AS provincia,
    ROUND(AVG(v.puntaje), 2) AS promedio_puntaje,
    COUNT(v.idValoracion) AS cantidad_valoraciones
FROM valoracion v
JOIN destino_turistico dt ON v.DESTINO_TURISTICO_Id_destino = dt.Id_destino
JOIN provincia p ON dt.PROVINCIA_Id_provincia = p.Id_provincia
WHERE MONTH(v.fecha_puntaje) = ? AND YEAR(v.fecha_puntaje) = ?
GROUP BY v.DESTINO_TURISTICO_Id_destino
ORDER BY promedio_puntaje DESC, cantidad_valoraciones DESC
LIMIT 10;
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $mes, $anio);
$stmt->execute();
$result = $stmt->get_result();
?>

