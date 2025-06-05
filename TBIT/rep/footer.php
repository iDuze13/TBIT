<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        html, body {
            height: auto;
            overflow-y: auto;
        }
        footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            padding: 40px 20px;
            font-size: 14px;
            color: #333;
            position: relative;
            flex-shrink: 0;
            width: 100%;
            bottom: 0;
        }
        .footer-content {
            margin-bottom: 100px;
        }
        .footer-bottom {
            font-size: 0.8em;
            color: #666;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            margin: 0 10px;
            color: #333;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #007bff;
        }

   </style>

</head>
<body>
    <footer>

        <div class="footer-content">
            <p>Gracias por visitar nuestro sitio web.</p>
            <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <div class="social-icons">
                <a href="#" class="icon has-text-black" onclick="event.preventDefault(); window.open('https://www.facebook.com/yourpage', '_blank')"><i class="fa-brands fa-facebook" ></i></a>
                <a href="#" class="icon has-text-black" onclick="event.preventDefault(); window.open('https://twitter.com/yourprofile', '_blank')"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="icon has-text-black" onclick=" event.preventDefault(); window.open('https://www.instagram.com/mati._13/', '_blank')"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="icon has-text-black" onclick="event.preventDefault(); window.open('https://wa.me/+5493704820930', '_blank')"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 TBIT. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>