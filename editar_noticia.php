<?php
require 'plantillas/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen = $_FILES['imagen']['name'];

    $stmt = $conn->prepare("UPDATE noticias SET titulo=?, contenido=?, imagen=? WHERE id=?");
    $stmt->bind_param("sssi", $titulo, $contenido, $imagen, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: admin_noticia.php");
    exit();
}

$id = $_GET['id'];
$noticia = $conn->query("SELECT * FROM noticias WHERE id = $id")->fetch_assoc();
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
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 bg-primary my-3 py-3" style="color: #ffffff;"> <!-- py=padding(margen interno) en eje y (vertical) -->
            <h2>Editar Noticias</h2>
            <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>
            <form action="admin_noticia.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="py-2">
                    <label for="titulo" class="form-label">Título</label>
                    <input class="form-control" id="titulo" rows="1" type="text" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>"><br>
                </div>
                <div class="py-1">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <textarea type="textarea" class="form-control" id="contenido" name="contenido"><?php echo htmlspecialchars($noticia['contenido']); ?></textarea><br>
                </div>
                <div class="d-grid gap-2 py-1">
                    <label for="imagen">Imagen:</label>
                    <input class="btn-secondary" type="file" name="imagen" accept="image/*" require>
                </div>
                <div class="d-grid gap-2 py-2">
                    <button class="btn btn-success" type="submit">Actualizar Noticia</button>
                </div>         
            </form>
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
