<?php
// rep/header.php
?>
<!-- Bulma CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<!-- Header/Navbar -->
<nav class="navbar is-white" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="#">
      <img src="./img/tbit-logo.png" alt="TBIT Logo" width="50" height="28">
      TBIT
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navMenu" class="navbar-menu">
<div id="navMenu" class="navbar-menu">
  <div class="navbar-start is-flex is-justify-content-center is-align-items-center" style="flex: 1;">
    <a class="navbar-item" href="index.php?vista=menu">Menú</a>
    <a class="navbar-item" href="index.php?vista=destinos">Destinos Turísticos</a>
    <a class="navbar-item" href="index.php?vista=comentarios">Comentarios</a>
    <a class="navbar-item" href="index.php?vista=favoritos">Favoritos</a>
  </div>


    <div class="navbar-end">
      <div class="navbar-item">
        <a class="icon has-text-black mr-3" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        <a class="icon has-text-black" href="#"><i class="fa-solid fa-language"></i></a>
        <a class="icon has-text-black mr-3" href="index.php?vista=login"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </div>
</nav>

<style>
  html, body {
    height: auto;
    overflow-y: auto;
  }
</style>



