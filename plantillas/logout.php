<?php
session_start(); // Iniciar la sesión para poder manipularla

// 1. Eliminar todas las variables de sesión
session_unset();

// 2. Destruir la sesión
session_destroy();

// 3. Redirigir al usuario a la página de inicio de sesión o inicio
header("Location: ../index.php"); // Redirige al usuario al login o cualquier otra página pública
exit(); // Detiene la ejecución del script para asegurar la redirección
?>
