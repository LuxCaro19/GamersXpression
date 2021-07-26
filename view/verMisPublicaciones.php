<?php
session_start();

use models\Publicacion as Publicacion;
use models\Gusta as Gusta;

require_once("../models/Publicacion.php");
require_once("../models/MeGusta.php");

$id = $_SESSION['user']['id_usuario'];
$modelo = new Publicacion();
$gusta = new Gusta();
$publicaciones = $modelo->cargarPublicacionesWhere($id);



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

    if (isset($_SESSION['user'])) { ?>



        <nav>

            <div class="nav-wrapper indigo darken-4">


                <img src="../img/Logo.png" alt="">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <?php if ($_SESSION['user']['id_tipo_usuario']==2){?>
                    <li><a href="crearJuego.php">Nuevo Juego</a></li>
                    <li><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>
                
                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
                    <li class="active"><a>Mis Publicaciones</a></li>
                    <li><a href="videojuegosList.php">Ver Videojuegos</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                    <li><a><span class="white-text tam">
                                <<-| Usuario: <?= $_SESSION['user']['nombre'] ?> |->>
                            </span></a></li>

                </ul>

            </div>
        </nav>

        <div class="container">

            <div class="row view-publicacion">



                <div class="card">

                    <div class="cont-createPubl">

                        <div class="icon-panel">


                            <img src="../img/Icon.png" alt="">


                        </div>

                        <a href="crearPublicacion.php">
                            <div class="box-realizarPubl">


                                <p>¡Expresa tu opinion! Escribe aquí tu opinion y publica</p>





                            </div>
                        </a>


                    </div>










                </div>

                <?php foreach ($publicaciones as $p) { ?>

                    <div class="card">



                        <form action="../controllers/EliminarPublicacion.php" method="POST">



                            <button class="right deleteButton" name="id_elim" id="id_elim" value=<?= $p["id_publicacion"] ?>>
                                <i class="Small material-icons black-text">delete</i>

                            </button>




                        </form>


                        <div class="card-content">

                            <span class="right">Videojuego: <a href="detalleJuego.php?id_juego=<?=$p["id_juego"] ?>"><?= $p["juego"]  ?></a></span>
                            <h4><?= $p["titulo"]  ?></h4>
                            <span>Publicado por: <?= $p["usuario"] ?></span>
                            <span class="right"> <?= $p["fecha"]  ?> </span>


                            <div class="contenido">

                                <p>

                                    <?= $p["contenido"]  ?>

                                </p>

                            </div>







                        </div>

                        <form action="detallePublicacion.php" method="GET">

                            <button class="right detailButton" name="id" id="id" value=<?= $p["id_publicacion"] ?>>Ver publicacion</button>

                        </form>


                        <div class="info-likes-comments">


                            <span>
                                <!-- este formulario es para poder enviar el id de la publicacion al controlador al momento de dar "me gusta    " -->
                                <form action="../controllers/ControlMeGusta.php" method="POST">

                                    <input type="hidden" name="id_publicacion" value="<?= $p["id_publicacion"] ?>" />
                                    <a href="#" onclick="this.parentNode.submit()">
                                        <img src="../img/likeIcon.png" alt=""> <?= $gusta->Buscar($p["id_publicacion"])["0"]["total"] ?>

                                    </a>

                                </form>

                            </span>
                            <span class="margin-left-span">
                                Comentarios:

                                <?php

                                $idValue = $p["id_publicacion"];

                                $count_comment = $modelo->commentCount($idValue);

                                foreach ($count_comment as $c) {

                                    echo $c["count"];
                                }

                                ?>




                            </span>




                        </div>



                    </div>

                <?php } ?>

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

</html>
