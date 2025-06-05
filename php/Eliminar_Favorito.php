<?php
require_once("conexion.php");
session_start();

$conn = conect();
$idFavorito = $_POST['idFAVORITO'] ?? null;

if ($idFavorito) {
    $stmt = $conn->prepare("DELETE FROM favorito WHERE idFAVORITO = ?");
    $stmt->bind_param("i", $idFavorito);
    $stmt->execute();
    $stmt->close();
}

header("Location: Favoritos.php");
exit();
