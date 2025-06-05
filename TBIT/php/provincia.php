<?php
require_once("conexion.php");

// Obtener el ID desde la URL
$id = isset($_GET['Id_provincia']) ? (int) $_GET['Id_provincia'] : 0;

$conn = conect();
if (!$conn) {
    die("Error de conexión a la base de datos.");
}

// Consulta a la base por ID
$sql = "SELECT PROVINCIA_nombre, PROVINCIA_relieve, PROVINCIA_region FROM provincia WHERE Id_provincia = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" para entero
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    echo "<h1>" . htmlspecialchars($fila['PROVINCIA_nombre']) . "</h1>";
    echo "<p>" . nl2br(htmlspecialchars($fila['PROVINCIA_relieve'])) . "</p>";
    echo "<p><strong>Región:</strong> " . htmlspecialchars($fila['PROVINCIA_region']) . "</p>";
} else {
    echo "Provincia no encontrada.";
}

$stmt->close();
$conn->close();
?>
