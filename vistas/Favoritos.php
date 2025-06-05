<!DOCTYPE html>
<html>
<head>
    <title>Mis Favoritos</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; margin: 0; padding: 20px; }
        .card-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
        }
        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card h3 { margin: 10px 0 5px; }
        .card p { margin: 5px 0; font-size: 14px; color: #333; }
        .actions { margin-top: 10px; display: flex; justify-content: space-between; }
        .btn { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-danger { background-color: #e74c3c; color: white; }
        .btn-primary { background-color: #3498db; color: white; }
    </style>
</head>
<body>

<h1>Tus Destinos Favoritos</h1>

<div class="card-container">
    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
        <div class="card">
            <img src="../imagenes/destinos/<?= $row['Id_destino'] ?>.jpg" alt="Imagen de <?= $row['DESTINO_TURISTICO_nombre'] ?>">
            <h3><?= $row['DESTINO_TURISTICO_nombre'] ?></h3>
            <p><strong>Tipo:</strong> <?= $row['DESTINO_TURISTICO_tipo_destino'] ?></p>
            <p><?= substr($row['DESTINO_TURISTICO_descripcion'], 0, 100) . "..." ?></p>
            <div class="actions">
                <form method="post" action="eliminar_favorito.php" style="margin:0;">
                    <input type="hidden" name="idFAVORITO" value="<?= $row['idFAVORITO'] ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <a href="detalle_destino.php?id=<?= $row['Id_destino'] ?>" class="btn btn-primary">Ver Detalles</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
