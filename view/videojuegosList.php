<?php

use models\Videojuego as Videojuego;

require_once("../models/Videojuego.php");

$juego = new Videojuego();
//cantidad es la cantidad de elementos que se mostraran por pagina
$cantidad = 12;
//pagina por defecto que deberia mostrarse
$pagina = 0;
//pregunta si esta definido algun parametro en la busqueda, al principio este no deberia buscar nada
if (isset($_GET['busqueda'])) {

    //pregunta si se encuentra en una pagina, las paginas comienzan desde 0
    if (isset($_GET['pagina'])) {
        //en la variable pagina se guardara la cantidad de objetos que deben saltarse para empezar a mostrar los obbjetos respectivos
        //ejemplo, si se encuentra en la pagina 3 y en cada pagina se muestran 10 elementos, deberia saltarse los primeros 20 elementos
        $pagina = $_GET['pagina'] * $cantidad;
    } else {
        //si se encuentra en la primera pagina, no deberia saltarse ningun objeto al momento de mostrar algo

    }

    $palabra = $_GET['busqueda'];
} else {
    //si no hay un parametro definido en la busqueda, no buscara nada y devolvera todos lo videojuegos en la base de datos
    $palabra = "";
}

$listajuegos = $juego->buscarVideojuegos($palabra, $pagina, $cantidad);
$cantidadresultados = $juego->contarBusquedaVideojuegos($palabra);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>


    <?php
    session_start();
    if (isset($_SESSION['user'])) { ?>



        <nav>

            <div class="nav-wrapper indigo darken-4">


                <img src="../img/Logo.png" alt="">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    <li><a href="publicaciones.php">Ver Publicaciones</a></li>
                    <li><a href="verMisPublicaciones.php">Mis Publicaciones</a></li>
                    <li class="active"><a>Ver Videojuegos</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                    <li><a><span class="white-text tam">
                                <<-| Usuario: <?= $_SESSION['user']['nombre'] ?> |->>
                            </span></a></li>

                </ul>

            </div>
        </nav>

        <div class="container">

            <div class="row">

                <!-- Este es el formulario de busqueda de juego -->

                <div class="col l12 m12 s12">
                    <div class="card">
                        <form action="" method="get">
                            <div class="items-comentar">
                                <div class="input-field per">

                                    <input type="text" name="busqueda">
                                    <label for="">Busca un videojuego en especifico</label>


                                </div>

                                <div class="input-field back-field-desactived">

                                    <button class="right detailButton details" type="submit" name="action">
                                        <i class="material-icons center">search</i>
                                    </button>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>

                <!-- Aqui se cargan todos los juegos almacenados en listajuegos -->

                <?php foreach ($listajuegos as $j) {; ?>



                    <div class="col l3 m4 s6">
                        <div class="card">
                            <div class="card-image gamebox">
                                <?= '<img class = "gameimage" src="data:image/jpeg;base64,' . base64_encode($j['imagen']) . '"/>' ?>

                                <span class="card-title"><?= $j["nombre"]  ?></span>
                            </div>
                            <div class="card-content">
                                <p class="truncate"><?= $j["historia_resumida"]  ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>


                <!-- Esta es la barra de navegacion de paginas -->
                <div class="col l12 m12 s12">

                    <ul class="pagination">


                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>

                        <!-- Este formulario recupera la informacion de la busqueda y agrega la pagina -->
                        <?php for ($i = 0; $i <= intdiv($cantidadresultados["0"]["cantidad"], $cantidad) - 1; $i++) {; ?>
                            <li class="active">


                                <form action="videojuegosList.php" method="GET">

                                    <input type="hidden" name="busqueda" value="<?= $_GET['busqueda'] ?>" />
                                    <input type="hidden" name="pagina" value="<?= $i ?>" />
                                    <a href="#" onclick="this.parentNode.submit()"><?= $i + 1 ?></a>

                                </form>

                            </li>
                        <?php } ?>


                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>

                    </ul>
                </div>

            </div>

        </div>




    <?php } else { ?>




        <div class="container center">

            <div class="row error">

                <div class="col l6 m6 s12 offset-l3 offset-m3">

                    <div class="card">

                        <div class="card-content">

                            <img src="../img/logoOptica.png" alt="">

                            <h2 class="red-text">Te has equivocado de camino amigo</h2>
                            <h4 class="black-text">no dispones de accesso para estar aquí</h4>
                            <p>Debes iniciar sesión, vuelve al <a href="../index.php">home</a> e inicia sesión.</p>
                            <p>Creadores de la pagina: <a href="../creadores.html">creadores</a></p>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php } ?>




</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>