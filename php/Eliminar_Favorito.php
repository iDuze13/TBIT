<?php
require_once("../conexion.php");
session_start();

$conexion = conect();
$id = $_POST['idFAVORITO'] ?? null;

if ($id) {
    $stmt = $conexion->prepare("DELETE FROM favorito WHERE idFAVORITO = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: Favoritos.php");
exit();
