<?php
require_once 'conexion.php';

$conn = conect();

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "SELECT 
            P.PERSONA_nombre, 
            P.PERSONA_apellido,
            C.COMENTARIO_fecha_P,
            C.COMENTARIO_caracteres,
            D.DESTINO_TURISTICO_nombre,
            PR.PROVINCIA_nombre
        FROM COMENTARIO C
        INNER JOIN USUARIO U ON C.USUARIO_idUSUARIO = U.idUSUARIO
        INNER JOIN PERSONA P ON U.PERSONA_ID_PERSONA = P.ID_PERSONA
        INNER JOIN DESTINO_TURISTICO D 
            ON C.DESTINO_TURISTICO_Id_destino = D.Id_destino 
            AND C.DESTINO_TURISTICO_PROVINCIA_Id_provincia = D.PROVINCIA_Id_provincia
        INNER JOIN PROVINCIA PR ON D.PROVINCIA_Id_provincia = PR.Id_provincia
        ORDER BY C.COMENTARIO_fecha_P DESC";

$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios</title>
    <style>
        body {
            background-color: #f2f2f2;
            padding: 2px;
        }

        h1 {
            text-align: center;
        }

        .comentarios-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 300px;
            padding: 20px;
            box-sizing: border-box;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card h2 {
            margin: 0;
            font-size: 20px;
            color: #0077cc;
        }

        .card .fecha {
            font-size: 12px;
            color: #888;
            margin-bottom: 10px;
        }

        .card .destino {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .card .comentario {
            font-size: 14px;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Comentarios recientes</h1>

<div class="comentarios-container">
    <?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
        <div class="card">
            <h2><?php echo htmlspecialchars($fila['PERSONA_nombre'] . ' ' . $fila['PERSONA_apellido']); ?></h2>
            <div class="fecha"><?php echo htmlspecialchars($fila['COMENTARIO_fecha_P']); ?></div>
            <div class="destino"><?php echo htmlspecialchars($fila['DESTINO_TURISTICO_nombre'] . ' - ' . $fila['PROVINCIA_nombre']); ?></div>
            <div class="comentario"><?php echo nl2br(htmlspecialchars($fila['COMENTARIO_caracteres'])); ?></div>
        </div>
    <?php endwhile; ?>
</div>

<?php
mysqli_close($conn);
?>

</body>
</html>
