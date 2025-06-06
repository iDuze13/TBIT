<?php
function conect(){
    $host = "localhost";
    $usuario = "root";
    $contrasena = "";
    $basededatos = "destinosturisticos"; 

    return mysqli_connect($host, $usuario, $contrasena, $basededatos);

}
if (!$conexion = conect()) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}