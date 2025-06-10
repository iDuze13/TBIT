

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Favoritos</title>
    <link rel="stylesheet" href="../css/Favoritos.css">
</head>

<body>
    <section> <?php 

include("./rep/header.php");


?></section>
<div class="favoritos-header">
    <h2>Tus Destinos Favoritos</h2>
    <p>Administrá y volvé a visitar los lugares que has amado o soñás con explorar.</p>
</div>

<div class="favoritos-container">
   <?php include("./php/controlador_Favoritos.php"); ?>
   <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
       <?php while ($fila = mysqli_fetch_assoc($resultado)) : ?>
           <div class="card">
            <img class="card-img"
                src="../img/<?php
                    if ($fila['DESTINO_TURISTICO_nombre'] === 'Parque Nacional Iguazú') {
                        echo 'Parque_Nacional_Iguazu.png';
                    } elseif ($fila['DESTINO_TURISTICO_nombre'] === 'Aconcagua') {
                        echo 'Aconcagua.png';
                    } else {
                        echo 'default.png';
                    }
                ?>"
                alt="Imagen destino">

               <div class="card-content">
                   <h2><?php echo htmlspecialchars($fila['DESTINO_TURISTICO_nombre']); ?></h2>
                   <div class="destino"><?php echo htmlspecialchars($fila['DESTINO_TURISTICO_tipo_destino']); ?></div>
                   <div class="comentario"><?php echo htmlspecialchars($fila['DESTINO_TURISTICO_descripcion']); ?></div>
                   <div class="popularidad">Popularidad: <?php echo htmlspecialchars($fila['DESTINO_TURISTICO_popularidad']); ?> ⭐</div>
                   <div class="card-buttons">
                       <form method="post" action="./php/Eliminar_Favorito.php" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este favorito?');">
                           <input type="hidden" name="idFAVORITO" value="<?php echo $fila['idFAVORITO']; ?>">
                           <button type="submit" class="btn btn-danger">Eliminar</button>
                       </form>
                       <a href="index.php?vista=DetalleDestino&id=<?php echo $fila['Id_destino']; ?>" class="btn btn-primary">Ver Detalle</a>
                   </div>
               </div>
           </div>

       <?php endwhile; ?>
   <?php else: ?>
       <div class="no-favoritos">
           <p>No tenés destinos favoritos todavía.</p>
       </div>
   <?php endif; ?>
</div>

    <section> <?php  
    include("./rep/footer.php");
    ?>
    </section>
           
<?php
if (isset($conexion)) {
    mysqli_close($conexion);
}
?>
</body>
</html>