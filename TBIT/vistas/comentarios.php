<?php
include "./rep/header.php";
// Mostrar mensaje de sesión si existe
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];

    if (is_array($mensaje)) {
        // Mostrar mensaje en formato personalizado
        echo '<div class="mensaje ' . htmlspecialchars($mensaje['tipo']) . '">';
        echo htmlspecialchars($mensaje['texto']);
        echo '</div>';
    } else {
        // Mostrar directamente el HTML (ya viene con <div> etc.)
        echo $mensaje;
    }

    unset($_SESSION['mensaje']);
}

?>

<!-- Enlaces CSS -->
<link rel="stylesheet" href="./css/valoracion.css">
<link rel="stylesheet" href="./css/comentarios.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- HERO SECTION -->
<section class="hero-section">
  <div class="hero-background">
    <div class="hero-overlay">
      <div class="hero-content">
        <div class="content-wrapper">
          <i class="fa-solid fa-comments hero-icon"></i>
          <h1 class="main-title">Qué Dicen los Turistas</h1>
          <p class="subtitle">Descubra experiencias reales, reseñas honestas y valiosos consejos de nuestra comunidad de turistas.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FILTROS O ORDER BY (pendiente) -->
<section>
  <h2>aca va el order by y eso</h2>
</section>

<!-- FORMULARIO DE COMENTARIOS -->
<section>
  <h1>comparti tu opinion</h1>
  <h3>Ayude a otros viajeros compartiendo sus pensamientos y calificaciones sobre los destinos que has visitado.</h3>
  <form action="./php/comentarios.php" method="POST" class="formulario-comentario">
    
    <!-- DESTINO -->
    <label for="destino">Selecciona un destino:</label>
    <select name="destino" id="destino" required>
      <option value="">-- Selecciona un destino --</option>
      <?php include("./php/destinosel.php"); ?>
    </select>

    <br><br>

    <!-- VALORACIÓN CON ESTRELLAS -->
    <label for="rating">Valoración:</label>
    <div class="radio">
      <input id="rating-5" type="radio" name="rating" value="5" required />
      <label for="rating-5" title="5 estrellas">★</label>

      <input id="rating-4" type="radio" name="rating" value="4" />
      <label for="rating-4" title="4 estrellas">★</label>

      <input id="rating-3" type="radio" name="rating" value="3" />
      <label for="rating-3" title="3 estrellas">★</label>

      <input id="rating-2" type="radio" name="rating" value="2" />
      <label for="rating-2" title="2 estrellas">★</label>

      <input id="rating-1" type="radio" name="rating" value="1" />
      <label for="rating-1" title="1 estrella">★</label>
    </div>

    <br><br>

    <!-- CAMPO DE COMENTARIO -->
    <label for="comentario">Comentario (opcional):</label>
    <textarea 
      name="comentario" 
      id="comentario" 
      rows="4" 
      cols="50" 
      placeholder="Comparte tu experiencia sobre este destino... (máximo 300 caracteres)"
      maxlength="300"
      oninput="this.value = this.value.trimStart();"></textarea>

    <br><br>

    <!-- BOTÓN DE ENVÍO -->
    <button type="submit">Enviar Comentario y Valoración</button>

  </form>
</section>


<section>
<?php include("./php/mostrarC.php"); ?>
</section>