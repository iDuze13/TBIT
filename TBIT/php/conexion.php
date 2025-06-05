<?php
function conect(){
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "destinosturisticos"; 

    return mysqli_connect($host, $usuario, $contrasena, $basededatos);

}