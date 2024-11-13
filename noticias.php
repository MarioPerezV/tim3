<?php
// Incluir el archivo de conexión a la base de datos
require_once 'plantillas/conexion.php';
session_start(); // Para asegurar que se inicie la sesión
// Verifica si el usuario está autenticado
if (!isset($_SESSION['nombreUsuario'])) {
    // Redirige a la página de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit();
}
// Consulta para obtener las noticias ordenadas por fecha de publicación
$sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/ecoma.ico" />
    <title>MarioPerezV_TIM3_ProgramacionAppWeb</title>
    <link rel="stylesheet" href="estilos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body><!-- Navbar -->
    <header>
        <?php require 'plantillas/navbar.php'; ?> <!-- Incluiye la barra de navegación -->
    </header>
<!-- Contenedor de noticias -->
    <div class="container my-5 py-5">
        <h1 class="text-center">Últimas Noticias</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '    <div class="card">';
                    echo '        <img src="' . htmlspecialchars($row['imagen']) . '" class="card-img-top" alt="Imagen de la noticia">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . htmlspecialchars($row['titulo']) . '</h5>';
                    echo '            <p class="card-text">' . htmlspecialchars($row['contenido']) . '</p>';
                    echo '            <p class="text-muted">Publicado el ' . htmlspecialchars($row['fecha_publicacion']) . '</p>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">No hay noticias para mostrar.</p>';
            }
            ?>
        </div>
    </div>
<script async src="https://cdn.jsdelivr.net/npm/es-module-shims@1/dist/es-module-shims.min.js" crossorigin="anonymous"></script>
<script type="importmap">
{
    "imports": {
        "@popperjs/core": "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/esm/popper.min.js",
        "bootstrap": "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.esm.min.js"
    }
}
</script>
<script type="module">
    import * as bootstrap from 'bootstrap'
    new bootstrap.Popover(document.getElementById('popoverButton'))
</script>
</body>
<footer class="text-center mt-5 bg-primary">    
    <h5>Mario Alejandro Pérez Vilchez <br>Servicios Informaticos Ecoma Ltda<br>Todos los derechos reservados 2024</h5>
</footer>
</html>