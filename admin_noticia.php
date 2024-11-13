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
// Verificar si el usuario está logueado (agregar validación de login aquí si es necesario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen = $_FILES['imagen']['name'];
    $ruta_imagen = "img/" . basename($imagen);   

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        $stmt = $conn->prepare("INSERT INTO noticias (titulo, contenido, imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titulo, $contenido, $ruta_imagen);
        $stmt->execute();
        $stmt->close();
        $mensaje = "Noticia creada exitosamente.";
    } else {
        $mensaje = "Error al subir la imagen.";
    }
}
// Obtener todas las noticias para listar
$noticias = $conn->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC");
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
<body>
<header>
<?php require 'plantillas/navbar.php'; ?> <!-- Incluiye la barra de navegación -->
</header>
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 bg-primary my-3 py-3" style="color: #ffffff;"> <!-- py=padding(margen interno) en eje y (vertical) -->
            <h2>Agregar Noticias</h2>
            <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
            <form action="admin_noticia.php" method="POST" enctype="multipart/form-data">
                <div class="py-2">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" rows="1" name="titulo" placeholder="titulo" required>
                </div>
                <div class="py-2">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <textarea type="textarea" class="form-control" id="contenido" name="contenido" placeholder="contenido" required></textarea>
                </div>
                <div class="d-grid gap-2 py-2">
                    <label for="imagen">Imagen:</label>
                    <input class="btn-secondary" type="file" name="imagen" accept="image/*" required>
                </div>
                <div class="d-grid gap-2 py-2">
                    <button class="btn btn-success" type="submit">Crear Noticia</button>
                </div>         
            </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 bg-light my-3 p-3" style="color: blue;">
            <div class="container text-center">
                <h2 class="text-center">Noticias Existentes </h2><!-- Listar Noticias -->
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha publicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="centrado">
                    <?php while ($noticia = $noticias->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($noticia['titulo']); ?></td>
                        <td><?php echo $noticia['fecha_publicacion']; ?></td>
                        <td>
                            <a href="editar_noticia.php?id=<?php echo $noticia['id']; ?>">Editar</a> |
                            <a href="plantillas/eliminar_noticia.php?id=<?php echo $noticia['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>  
        </div>
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
