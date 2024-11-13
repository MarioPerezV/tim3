

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <img src="img/logo.png" class="rounded" alt="Logo club ajedrez" width="40">
        <a class="navbar-brand" href="#">Club de Ajedrez<br> Gambito de Capablanca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="registro.php">Registrarse</a>
                </li>
                <?php if (isset($_SESSION['nombreUsuario']) && isset($_SESSION['categoria'])): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="noticias.php">Noticias</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="admin_noticia.php">Admin. Noticias</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Opciones</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Cadetes</a></li>
                        <li><a class="dropdown-item" href="#">Capitanes</a></li>
                        <li><a class="dropdown-item" href="#">Solo Maestros</a></li>
                    </ul>
                </li>
                
<!-- Mostrar saludo personalizado y botón de cerrar sesión si el usuario ha iniciado sesión, sale demasiado claro-->
                <li class="nav-item active">
                    <a class="navbar-text mx-5" style="color: white;">Bienvenido, <?php echo htmlspecialchars($_SESSION['categoria'] . ' ' . $_SESSION['nombreUsuario']); ?></a>
                </li>
                <li class="nav-item">
                    <a href="plantillas/logout.php" class="btn btn-primary">Cerrar Sesión</a>
                </li>
                <?php else: ?>
                <!-- Mostrar botón de iniciar sesión si el usuario no ha iniciado sesión -->
                <li class="nav-item">
                    <a href="index.php" class="btn btn-success">Iniciar Sesión</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>