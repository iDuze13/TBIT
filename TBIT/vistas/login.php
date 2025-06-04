<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login TBIT</title>
  <link rel="stylesheet" href="./css/estilos.css">
  <style>
</style>
</head>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['mensaje'])) {
    echo $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
}
?>
  

<body class="login-background">
  <section class="section is-flex is-justify-content-center is-align-items-center min-vh-100">
    <div class="box has-text-centered" style="background-color: rgba(255, 255, 255, 0.4); backdrop-filter: blur(6px);">
      <figure class="image is-96x96 is-inline-block mb-4">
        <img src="./img/tbit-logo.png" alt="Logo">
      </figure>

      <form action="./php/login.php" method="post" autocomplete="off">
        <div class="field">
        <div class="control">
            <input class="input is-rounded" type="text" name="usuario" placeholder="Usuario" required
            style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
        </div>
        </div>
        <div class="field">
        <div class="control">
            <input class="input is-rounded" type="password" name="contrasena" placeholder="Contraseña" required
            style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
        </div>
        </div>

        <div class="buttons is-centered mt-4">
          <button type="submit" class="button is-light is-rounded">Iniciar Sesión</button>
          <a href="index.php?vista=registro" class="button is-white is-rounded">Registrarse</a>

        </div>
      </form>
    </div>
  </section>

  <footer class="has-text-black has-text-centered p-4" style="background-color: rgba(255, 255, 255, 0.0); backdrop-filter: blur(1px);">
  
  <a href="./vistas/quienes_somos.php" style="color: white; margin: 0 10px;">¿Quiénes somos?</a>
  <a href="./vistas/contacto.php" style="color: white; margin: 0 10px;">Contacto</a>
  <a href="#"><img src="./img/whatsapp-icon.png" alt="WhatsApp" style="width: 30px;" onclick="window.open('https://wa.me/+5493704820930', '_blank')"></a>
  <p>© 2025 TBIT. Todos los derechos reservados.</p>
  </footer>


</body>
</html>
