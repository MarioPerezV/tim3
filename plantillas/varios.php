<?php 
// Las 5 imágenes
$img1='<img src="img/B1.png" class="rounded" width="200" alt="primer Desafío juegan blancas">';
$img2='<img src="img/N1.png" class="rounded-circle" width="200" alt="segundo Desafío juegan negras">';
$img3='<img src="img/B2.png" class="rounded" width="200" alt="tercer Desafío juegan blancas">';
$img4='<img src="img/N2.png" class="rounded-circle" width="200" alt="cuarto Desafío juegan negras">';
$img5='<img src="img/B3.png" class="rounded" width="200" alt="quinto Desafío juegan blancas">';
// Los 5 párrafos
$parrafo1='<p class="parrafo-1">El ajedrez es más que un simple juego, es una actividad que estimula la mente y fomenta el pensamiento estratégico. Un club permite a los miembros intercambiar conocimientos, mejorar sus habilidades y disfrutar de la competencia amistosa, creando así una comunidad unida por el amor al juego.</p>';
$parrafo2='<p class="parrafo-2">Los torneos son una parte fundamental de la vida de nuestro club de ajedrez. Estos eventos no solo permiten a los jugadores medir sus habilidades contra otros, sino que también generan un sentido de comunidad y motivación.</p>';
$parrafo3='<p class="parrafo-3">Promueve el desarrollo de habilidades sociales. A través de la interacción constante con otros miembros, los jugadores aprenden a comunicarse mejor, a trabajar en equipo y a respetar a sus oponentes. Estas habilidades también se trasladan a otras áreas de la vida, fortaleciendo la autoestima y fomentando un ambiente de apoyo mutuo.</p>';
$parrafo4='<p class="parrafo-4">Uno de los principales beneficios de pertenecer a nuestro club de ajedrez es el acceso a un entorno de aprendizaje enriquecedor. Los jugadores experimentados pueden actuar como mentores para los principiantes, ofreciendo consejos y tácticas que pueden transformar la manera en que juegan.</p>';
$parrafo5='<p class="parrafo-5">Las personas de todas las edades y niveles de habilidad son bienvenidas, lo que enriquece la experiencia de todos los miembros. La diversidad de perspectivas y estilos de juego en nuestro club fomenta un entorno en el que todos pueden aprender y disfrutar del ajedrez, creando una comunidad vibrante y activa que trasciende el simple hecho de jugar.</p>';
// Carrusel
$carrusel='<div class="container text-center my-3">
            <div id="carouselExampleIndicators" class="carousel slide mt-3" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <img class="d-block w-30" src="img/B2.png" alt="primera imagen">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="negra">Juegan Blancas</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img class="d-block w-30" src="img/N2.png" alt="segunda imagen">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="negra">Juegan Negras</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center">
                            <img class="d-block w-30" src="img/B3.png" alt="tercera imagen">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h2 class="negra">Juegan Blancas</h2>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </a>
            </div>
        </div>';
if ($olvido < 18) {
    echo "<h2>Datos recibidos:</h2>";
    echo "<h4>Nombre: " . $nombreUsuario . "<br>";
    //echo "Contraseña: " . $edad . "<br>";
    echo "Olvidó su contraseña?: " . $olvido . "</h4><br>al final de la página está la información<br>";
    echo '<h3 class="text-center">Tenemos desafíos para menores de edad:</h3>';
    echo $img1;
    echo $img2;
    echo '<h3>Información para menores de edad:</h3>';
    echo $parrafo3;
    echo $parrafo4;
    echo $parrafo5;
} else if ($olvido >= 18) {
    echo "<h2>Datos recibidos:</h2>";
    echo "<h4>Nombre: " . $nombre . "<br>";
    //echo "Edad: " . $edad . "<br>";
    echo "Información adicional: " . $interesado . "</h4><br>al final de la página está la información<br>";
    echo '<h3 class="text-center">Tenemos desafíos para mayores de edad:</h3>';
    echo $img3;
    echo $img4;
    echo $img5;
    echo '<h3>Información para mayores de edad:</h3>';
    echo $parrafo1;
    echo $parrafo2;
} else {
    $nombreUsuario = $olvido = "";
} 
if ($olvido == 'Sí'){
    echo '<h1>Vemos que estas interesado</h1>';
    echo $carrusel;
}
?>