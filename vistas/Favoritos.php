<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Favorito</title>
    <style>
        body {
            background-color: #f2f2f2;
            padding: 2px;
        }

        h1 {
            text-align: center;
        }

        .Favoritos-container {
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

<h1>Favoritos</h1>

<div class="Favoritos-container">
   <?php include("./php/controlador_Favoritos.php"); ?>
   <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
       <?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
           <div class="card">
               
            <div class="destino"><?php echo htmlspecialchars($fila['DESTINO_TURISTICO_nombre_destino']); ?></div>
            <div class="comentario"><?php echo htmlspecialchars($fila['USUARIO_idUSUARIO']); ?></div>
           </div>
       <?php endwhile; ?>
   <?php else: ?>
       <p>No tenés destinos favoritos todavía.</p>
   <?php endif; ?>
</div>
<?php
if (isset($conexion)) {
    mysqli_close($conexion);
}
?>

</body>
</html>