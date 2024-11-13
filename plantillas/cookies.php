<?php // A mode de experimento y aprender sobre las cookies
// Incluir el archivo de conexión
require_once 'conexion.php';

function storeCookieInDatabase($cookieName, $cookieValue, $userId, $expirationDate) {
    global $conn; // Usa la conexión establecida en conexion.php

    // Prepara la consulta para insertar los datos de la cookie
    $stmt = $conn->prepare("INSERT INTO cookies_info (cookie_name, cookie_value, user_id, expiration_date) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssis", $cookieName, $cookieValue, $userId, $expirationDate);
        $stmt->execute();
        $stmt->close();
    } else {
        // Maneja el error si la consulta no se prepara correctamente
        echo "Error al preparar la consulta: " . $conn->error;
    }
}
?>
