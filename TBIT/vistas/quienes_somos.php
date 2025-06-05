<!DOCTYPE html>
<html lang="es">

<head>
  <header style="background-color: #1f1f1f; padding: 8px 10px; text-align: left;">
  <a href="../index.php" style="color: white; text-decoration: none; font-weight: golden wave; font-size: 1.0rem;">
    ⬅ Volver al inicio
  </a>
</header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>
    <link rel="stylesheet" href="./css/estilos.css">
  <style>
  * {
    box-sizing: border-box;
  }

    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    /* SECCIÓN NEGRA */
    .encabezado {
      background-color: #1f1f1f;
      color: white;
      padding: 40px 20px;
      text-align: left;
    }

    .encabezado h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    /* SECCIÓN PRINCIPAL */
    .sobre-nosotros {
      background-color: white;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      padding: 60px 10%;
      gap: 30px;
    }

    /* TEXTO A LA IZQUIERDA */
    .texto {
      flex: 1 1 60%;
      font-size: 1.1rem;
      line-height: 1.6;
    }

    /* LOGO CIRCULAR A LA DERECHA */
    .logo {
      flex: 1 1 30%;
      display: flex;
      justify-content: center;
      align-items: center;
    }


    .logo img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solidrgb(254, 246, 246);
    }

    /* RESPONSIVE */
    @media screen and (max-width: 768px) {
      .sobre-nosotros {
        flex-direction: column;
        text-align: center;
      }

      .texto, .logo {
        flex: 1 1 100%;
      }

      .logo img {
        width: 160px;
        height: 160px;
      }
    }
  </style>
</head>
<body>

  <!-- Encabezado negro -->
  <section class="encabezado">
    <h1>Sobre nosotros</h1>
  </section>

  <!-- Contenido blanco con texto y logo -->
  <section class="sobre-nosotros">
    <!-- Texto -->
    <div class="texto">
      <p>En <strong>TBIT</strong>, somos un grupo de estudiantes de la Universidad de La Cuenca del Plata apasionados por los viajes y la cultura. Nuestro objetivo es brindarte una plataforma donde puedas descubrir destinos únicos, recibir consejos útiles y disfrutar de cada rincón del mundo con una mirada fresca y auténtica.</p>
      <p>Nos enfocamos en la calidad de la información, el compromiso con los usuarios y la inspiración que nace del amor por explorar. Este proyecto nació del trabajo intercátedra de Programación III y Base de Datos I. Muchas gracias por el apoyo y por ayudarnos a mejorar.</p>
    </div>

    <!-- Logo -->
    <div class="logo">
      <img src="../img/tbit-logo.png" alt="Logo TBIT">
    </div>
  </section>
<footer class="footer" style="background-color: rgba(2, 2, 2, 0); backdrop-filter: blur(1px); text-align: center; padding: 20px;">
  <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
    <div>
      <a href="#"><img src="../img/Nagi.jpg" alt="nosotros" style="width: 30px; vertical-align: middle;"></a>
      <a href="./vistas/contacto.php" style="color: black; margin: 0 10px;">Contacto</a>
      <a href="#"><img src="../img/whatsapp-icon.png" alt="WhatsApp" style="width: 30px; vertical-align: middle;" onclick="window.open('https://wa.me/+5493704820930', '_blank')"></a>
    </div>
    <p style="color: black; margin: 0;">© 2025 TBIT. Todos los derechos reservados.</p>
  </div>
</footer>
</body>

</html>
