<?php
include "./rep/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<section class="hero is-fullheight" style="background: url('./img/Menu.png') center/cover no-repeat;">
  <div class="hero-body has-background-dark-transparent">
    <div class="container has-text-centered">
      <h1 class="title has-text-white is-size-2">
        Descubre lugares <br> dignos de una historia
      </h1>

      <form action="buscar.php" method="GET" class="field has-addons is-justify-content-center mt-5">
        <div class="control">
          <input class="input is-rounded" type="text" name="busqueda" placeholder="Buscar destino...">
        </div>
        <div class="control">
          <button class="button is-link is-rounded" type="submit">
            Search&nbsp;<i class="fa-solid fa-arrow-right ml-2"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<section class="section has-text-centered" style="background-image: url('./img/menu2.png'); background-size: cover; background-position: center; min-height: 100vh;">
  <div class="container is-flex is-justify-content-center is-align-items-center is-flex-direction-column" style="min-height: 100vh;">
    <h2 class="title has-text-white is-size-2">Los mejores destinos en toda la Argentina</h2>
    <a href="#destinos">
      <i class="fa-solid fa-arrow-down has-text-white mt-6 arrow-bounce" style="font-size: 2rem;"></i>
    </a>
  </div>
</section>

<section id="destinos" class="section">
  <div class="container">
    <h3 class="title is-3">Mas Populares</h3>
    <p>Tengo q ver como poner los Populares</p>
  </div>
</section>




<style>
  .has-background-dark-transparent {
    background-color: rgba(0, 0, 0, 0.4);
    padding: 2rem;
    border-radius: 10px;
  }
  .arrow-bounce {
    animation: bounce 2s infinite;
  }

  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(10px);
    }
  }

  html {
  scroll-behavior: smooth;
  }


</style>

