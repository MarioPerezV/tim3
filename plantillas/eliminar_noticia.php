<?php
require 'conexion.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: ../admin_noticia.php");
exit();
?>
