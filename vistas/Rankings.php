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
