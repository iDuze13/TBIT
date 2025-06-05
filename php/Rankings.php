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

<!DOCTYPE html>
<html>
<head>
    <title>Ranking de Destinos Turísticos</title>
</head>
<body>
    <h1>Ranking de los Mejores Destinos - <?php echo "$mes/$anio"; ?></h1>

    <form method="get">
        <label for="mes">Mes:</label>
        <select name="mes" id="mes">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $selected = ($i == $mes) ? "selected" : "";
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <label for="anio">Año:</label>
        <select name="anio" id="anio">
            <?php
            for ($y = 2023; $y <= date("Y"); $y++) {
                $selected = ($y == $anio) ? "selected" : "";
                echo "<option value='$y' $selected>$y</option>";
            }
            ?>
        </select>
        <input type="submit" value="Ver Ranking">
    </form>

    <table border="1">
        <tr>
            <th>Destino</th>
            <th>Provincia</th>
            <th>Promedio de Puntaje</th>
            <th>Cantidad de Valoraciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['destino'] ?></td>
            <td><?= $row['provincia'] ?></td>
            <td><?= $row['promedio_puntaje'] ?></td>
            <td><?= $row['cantidad_valoraciones'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
