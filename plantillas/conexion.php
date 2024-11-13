<?php
// Conexión a la base de datos
$host = "localhost:3306";
$dbname = "tim3";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer la duración de la sesión en segundos
ini_set('session.gc_maxlifetime', 300); // 1800 segundos = 30 minutos

// Asegurarse de que las cookies también respeten esta duración
session_set_cookie_params(300);

// Iniciar la sesión
session_start();

?>