<?php //Version(12-11)  Mario Perez Vilchez - API 3 - ProgAppWeb
require 'plantillas/conexion.php';
session_start(); // Para asegurar que se inicie la sesión
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombreUsuario'];
    $pass = $_POST['pass'];

    // Consulta a la base de datos para obtener usuario y categoría
    $sql = "SELECT nombreUsuario, contrasena, categoria FROM usuarios WHERE nombreUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($pass, $user['contrasena'])) {
            // Guardar el nombre de usuario y categoría en la sesión
            $_SESSION['nombreUsuario'] = $user['nombreUsuario'];
            $_SESSION['categoria'] = $user['categoria'];

            header("Location: index.php"); // Redirigir a página principal o área protegida
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}
// Experimentando con cookies
//require_once 'cookies_manager.php';
// Suponiendo que $usuario contiene los datos del usuario actual
//$cookieName = 'user_session_cookie';
//$cookieValue = session_id(); // Puedes usar el ID de sesión como valor.
//$userId = $usuario['id']; // ID del usuario actual desde la base de datos.
//$expirationDate = date('Y-m-d H:i:s', time() + 3600); // Expira en 1 hora.
// Almacenar la cookie en la base de datos
//storeCookieInDatabase($cookieName, $cookieValue, $userId, $expirationDate);
// Establecer la cookie en el navegador del usuario
//setcookie($cookieName, $cookieValue, time() + 3600, "/"); // Expira en 1 hora, accesible en todo el sitio.
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
            <h2>Formulario <br> Inicio de Sesión</h2>
            <form method="POST" action="index.php">
                <div class="py-2">
                    <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="nombreUsuario" rows="1" name="nombreUsuario" placeholder="Nombre del miembro" required>
                </div>
                <div class="py-2">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="contraseña" required>
                </div>
                <div class="py-2">
                    <label for="olvido">¿Olvidó su contraseña?</label>
                    <input type="checkbox" id="olvido" name="olvido"><br><br>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit">Iniciar Sesión</button>
                    <button class="btn btn-secondary" type="button" onclick="window.location.href='registro.php'">Registrarse</button>
                </div>         
            </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 bg-light my-3 p-3" style="color: blue;">
            <div class="container text-center">
                <img src="img/logo2.jpeg" alt="Logo club" width="300">
                <h2 class="text-center">Bienvenid@ al Club </h2> 
                <?php
                echo $resultado;
                ?>
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
    <!-- SE DEJA COMENTADA ESTA LINEA JS POR REDUNDANCIA EN LA PÁGINA al revisar:
    <script src="scripts.js"></script>-->
</footer>
</html>