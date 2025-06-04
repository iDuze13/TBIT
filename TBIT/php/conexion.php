<?php
function conect(){
    $host = "localhost";
    $usuario = "root";
    $contrasena = "123456789";
    $basededatos = "destinosturisticos"; 

    return mysqli_connect($host, $usuario, $contrasena, $basededatos);

}