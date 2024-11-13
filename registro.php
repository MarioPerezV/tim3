<?php
require 'plantillas/conexion.php';
session_start(); // Para asegurar que se inicie la sesión
$resultado = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST['nombreUsuario'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    // Verificar que el nombre de usuario no esté registrado
    $sql = "SELECT * FROM usuarios WHERE nombreUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resultado = "El nombre de usuario ya está registrado.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombreUsuario, contrasena, email) VALUES (?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombreUsuario, $hashed_password, $email); 
        // las 3 sss corresponde a la cantidad de parametros enviados de tipo string
        if ($stmt->execute()) {
            $resultado = "Registro exitoso. Ahora puedes iniciar sesión.";
            echo "<script>alert('$resultado');</script>";
            session_start();
            $_SESSION['nombreUsuario'] = $nombreUsuario;
            header("Location: registro.php"); // Redirigir a la página principal o área protegida
            
        } else {
            $resultado = "Error al registrar el usuario.";
        }
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/club.png" />
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
                <h2>Formulario <br> Registro de Usuario</h2>
                <form method="POST" action="registro.php">
                    <div class="py-2">
                        <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" rows="1" name="nombreUsuario" placeholder="Nombre usuario" required>
                    </div>
                    <div class="py-2">
                        <label for="E-mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" rows="1" name="email" placeholder="email" required>
                    </div>
                    <div class="py-2">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="contraseña" required>
                    </div>
                    <div class="d-grid gap-2 p-2">
                        <button class="btn btn-success" type="submit">Registrarse</button>
                    </div>         
                </form>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 bg-light my-3 p-3" style="color: blue;">
                <div class="container text-center">
                    <img src="img/club.jpeg" alt="Logo club" width="300">
                    <h2 class="text-center">Bienvenid@ al Club</h2>
                    <?php
                        echo "<h5>" . $resultado . "</h5>";                        
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