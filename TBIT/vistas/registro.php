<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro</title>
  <link rel="stylesheet" href="./css/registro.css" />
</head>
<body class="login-background">
  <div class="container pb-6 pt-6">
    <!-- Mostrar mensaje -->
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['mensaje'])){
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
    ?>

    <section class="section is-fullheight is-flex is-justify-content-center is-align-items-center">
      <div class="box has-text-centered" style="background-color: rgba(255, 255, 255, 0.4); backdrop-filter: blur(6px); max-width: 600px;">
        <figure class="image is-96x96 is-inline-block mb-4">
          <img src="./img/tbit-logo.png" alt="Logo" />
        </figure>

        <form action="./php/registro.php" method="post" autocomplete="off">
          <div class="columns is-multiline">
            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="text" name="cuil" placeholder="CUIL" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="text" name="nombre" placeholder="Nombre" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="text" name="apellido" placeholder="Apellido" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="text" name="nacionalidad" placeholder="Nacionalidad" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column is-half">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="email" name="correo" placeholder="Correo Electrónico" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>

            <div class="column">
              <div class="field">
                <div class="control">
                  <input class="input is-rounded" type="text" name="usuario" placeholder="Usuario" required
                    style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
                </div>
              </div>
            </div>
          </div>

          <div class="field">
            <div class="control">
              <input class="input is-rounded" type="password" name="contrasena" placeholder="Contraseña" required
                style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
            </div>
          </div>
          
          <div class="field">
            <div class="control">
              <input class="input is-rounded" type="password" name="confirmar_contrasena" placeholder="Confirmar Contraseña" required
                style="background-color: rgba(255, 255, 255, 0.4); color: #000;">
            </div>
          </div>

          <div class="buttons is-centered mt-4">
            <button type="submit" class="button is-light is-rounded">Registrarse</button>
            <a href="index.php?vista=login" class="button is-white is-rounded">Volver al Login</a>
          </div>
        </form>
      </div>
    </section>

<footer class="has-text-white has-text-centered p-4" style="background-color: #363636 leng;">
  <div class="container">
    <div class="columns is-vcentered is-centered">
      <div class="column is-narrow">
        <a href="./vistas/quienes_somos.php" class="has-text-white mx-3">¿Quiénes somos?</a>
        <a href="./vistas/contacto.php" class="has-text-white mx-3">Contacto</a>
        <a href="#"><img src="./img/whatsapp-icon.png" alt="WhatsApp" style="width: 30px; vertical-align: middle;" onclick="window.open('https://wa.me/+5493704820930', '_blank')" /></a>
      </div>
    </div>
  </div>
</footer>

  </div>
</body>
</html>
