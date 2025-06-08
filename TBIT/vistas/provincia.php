<?php
include('../rep/header.php');
include('../php/conexion.php');

$id_provincia = isset($_GET['Id_provincia']) ? intval($_GET['Id_provincia']) : die("Error: No se recibió el ID de la provincia.");

$conexion = conect();
if (!$conexion) die("Error en la conexión a la base de datos.");

// Verificar existencia tabla destino_turistico
$queryCheckTable = "SHOW TABLES LIKE 'destino_turistico'";
$resultadoCheck = $conexion->query($queryCheckTable);
$tablaExiste = ($resultadoCheck && $resultadoCheck->num_rows > 0);

// Info provincia
$queryProvincia = "SELECT * FROM provincia WHERE Id_provincia = $id_provincia";
$resultado = $conexion->query($queryProvincia);
if (!$resultado || $resultado->num_rows === 0) die("No se encontró información para la provincia.");
$provincia = $resultado->fetch_assoc();

// Traer todos los destinos turísticos asociados a esta provincia
$destinos = [];
if ($tablaExiste) {
    $queryDestino = "SELECT * FROM destino_turistico WHERE PROVINCIA_Id_provincia = $id_provincia ORDER BY Id_destino ASC";
    $resultadoDestino = $conexion->query($queryDestino);
    if ($resultadoDestino && $resultadoDestino->num_rows > 0) {
        while ($row = $resultadoDestino->fetch_assoc()) {
            $destinos[] = $row;
        }
    }
}

// Ruta imágenes
$carpetaImg = "../img/" . $id_provincia . "/";
$headerImg = file_exists($carpetaImg . "im1.jpg") ? $carpetaImg . "im1.jpg" : "../img/default_header.jpg";

// Cargar imágenes carrusel (im2 a im5)
$imagenesCarrusel = [];
for ($i = 2; $i <= 5; $i++) {
    $rutaImg = $carpetaImg . "im" . $i . ".jpg";
    if (file_exists($rutaImg)) {
        $imagenesCarrusel[] = $rutaImg;
    }
}


$destinos = array_slice($destinos, 0, count($imagenesCarrusel));
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Provincia - <?php echo htmlspecialchars($provincia['PROVINCIA_nombre']); ?></title>
<link rel="stylesheet" href="../estilos/nosotros.css" />

<style>
  body { background: #fff; font-family: 'Arial', Times, serif, sans-serif; }
  main { max-width: 1100px; margin: 40px auto; padding: 20px; display: flex; flex-direction: column; gap: 30px; }
  header {height: 400px; background-image: url('<?php echo $headerImg; ?>'); background-size: cover; display: flex; align-items: center; justify-content: center; color: rgb(248, 247, 247); font-size: 4.5rem; font-weight: 700; text-shadow: 2px 2px 6px rgb(0, 0, 0);
  text-align: center; padding: 100 20px;
  
}
  .info-cuadro { background: #f9f9f9; border-radius: 8px; padding: 20px; box-shadow: 0 0 8px rgba(218, 229, 17, 0.49); color:rgb(5, 5, 5); }
  .carrusel { position: relative; max-width: 450px; margin: auto; }
  .carrusel img { width: 100%; border-radius: 8px; }
  .info-destino { background: #fff3cd; color:rgb(5, 5, 5); padding: 15px; border-radius: 8px; margin-top: 10px; box-shadow: 0 0 8px rgba(218, 229, 17, 0.49); }
  .carrusel-buttons { display: flex; justify-content: center; gap: 10px; margin-top: 10px; }
  button { background: #2c3e50; color: #fff; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; }
  button:disabled { background: #ccc; cursor: default; }
</style>
</head>
<body>
<header>
  <?php echo htmlspecialchars($provincia['PROVINCIA_nombre']); ?>
</header>

<main>
  <section class="info-cuadro">
    <h2>Relieve</h2>
    <p><?php echo htmlspecialchars($provincia['PROVINCIA_relieve']); ?></p>
    <h2>Región</h2>
    <p><?php echo htmlspecialchars($provincia['PROVINCIA_region']); ?></p>
  </section>

  <section class="carrusel">
    <?php if (!empty($imagenesCarrusel)): ?>
      <img id="imagen-carrusel" src="<?php echo $imagenesCarrusel[0]; ?>" alt="Imagen turística" />
      <div class="carrusel-buttons">
        <button id="prev-btn" disabled>&lt; Prev</button>
        <button id="next-btn">Next &gt;</button>
      </div>
      <div class="info-destino" id="info-destino">
        <h3><?php echo htmlspecialchars($destinos[0]['DESTINO_TURISTICO_nombre'] ?? ''); ?></h3>
        <p><?php echo htmlspecialchars($destinos[0]['DESTINO_TURISTICO_descripcion'] ?? ''); ?></p>
        <small>Época recomendada: <?php echo htmlspecialchars($destinos[0]['DESTINO_TURISTICO_epoca'] ?? 'No disponible'); ?></small>
      </div>
    <?php else: ?>
      <p>No hay imágenes disponibles para mostrar.</p>
    <?php endif; ?>
  </section>
</main>

<?php include('../rep/footer.php'); ?>

<script>
  const imagenes = <?php echo json_encode($imagenesCarrusel); ?>;
  const destinos = <?php echo json_encode($destinos); ?>;
  let indice = 0;

  const imgCarrusel = document.getElementById('imagen-carrusel');
  const btnPrev = document.getElementById('prev-btn');
  const btnNext = document.getElementById('next-btn');
  const infoDestino = document.getElementById('info-destino');

  function actualizarBotones() {
    btnPrev.disabled = indice === 0;
    btnNext.disabled = indice === imagenes.length - 1;
  }

  function actualizarInfoDestino() {
    if(destinos[indice]) {
      infoDestino.querySelector('h3').textContent = destinos[indice].DESTINO_TURISTICO_nombre || '';
      infoDestino.querySelector('p').textContent = destinos[indice].DESTINO_TURISTICO_descripcion || '';
      infoDestino.querySelector('small').textContent = "Época recomendada: " + (destinos[indice].DESTINO_TURISTICO_epoca_recomendada);
    } else {
      infoDestino.innerHTML = '<p>No hay información disponible para este destino.</p>';
    }
  }

  btnPrev.addEventListener('click', () => {
    if (indice > 0) {
      indice--;
      imgCarrusel.src = imagenes[indice];
      actualizarBotones();
      actualizarInfoDestino();
    }
  });

  btnNext.addEventListener('click', () => {
    if (indice < imagenes.length - 1) {
      indice++;
      imgCarrusel.src = imagenes[indice];
      actualizarBotones();
      actualizarInfoDestino();
    }
  });
</script>
</body>
</html>
