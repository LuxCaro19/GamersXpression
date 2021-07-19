<?php


session_start();

use models\Publicacion as Publicacion;
use models\Comentarios as Comentarios;
use models\Gusta as Gusta;

require_once("../models/MeGusta.php");
require_once("../models/Publicacion.php");
require_once("../models/Comentarios.php");


$gusta = new Gusta();
$model = new Publicacion();
$coment = new Comentarios();







$count_comment = $model->commentCount($_GET['id']);
$comentarios = $coment->cargarComentarios($_GET['id']);
$publicacion = $model->cargarPublicacionSeleccionada($_GET['id']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicacion</title>
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


                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
                    <li><a href="verMisPublicaciones.php">Mis Publicaciones</a></li>
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




                <?php
                foreach ($publicacion as $p) { ?>

                    <div class="card">

                        <?php

                        if ($p["id_user"] == $_SESSION['user']['id_usuario']) { ?>


                            <form action="updatePublicacion.php" method="GET">


                                <button class="right updateButton" name="id_edit" id="id_edit" value=<?= $p["id_publicacion"] ?>>
                                    <i class="Small material-icons black-text">edit</i>

                                </button>


                            </form>


                            <form action="../controllers/EliminarPublicacion.php" method="POST">



                                <button class="right deleteButton" name="id_elim" id="id_elim" value=<?= $p["id_publicacion"] ?>>
                                    <i class="Small material-icons black-text">delete</i>

                                </button>






                            </form>


                        <?php } ?>



                        <div class="card-content">


                            <span class="right">Videojuego: <a href="detalleJuego.php?id_juego=<?= $p["id_juego"] ?>"><?= $p["juego"]  ?></a></span>
                            <h4><?= $p["titulo"]  ?></h4>
                            <span>Publicado por: <?= $p["usuario"] ?></span>
                            <span class="right"> <?= $p["fecha"]  ?> </span>


                            <div class="contenido">

                                <p>

                                    <?= $p["contenido"]  ?>

                                </p>

                            </div>

                        </div>

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




                        </div>

                        <div class="modify-img">
                        <?php if ($p['imgPublic'] != null) { ?>

                            <div class="card-image image-tam-public">
                                <?= '<img class = "" src="data:image/jpeg;base64,' . base64_encode($p['imgPublic']) . '"/>' ?>
                            </div>


                        <?php } ?>
                        </div>

                        <div class="card-content">
                            <div class="card-comentar">

                                <?php

                                if (isset($_SESSION['error'])) { ?>

                                    <h6 class="center red-text text-darken"> <?php echo $_SESSION['error'];  ?></h6>

                                <?php unset($_SESSION['error']);
                                }

                                ?>

                                <form action="../controllers/ControlComentario.php" method="POST">


                                    <div class="items-comentar">


                                        <div class="input-field per">

                                            <input type="text" name="comentario" id="comentario">
                                            <label for="nombre">Comenta esta publicacion</label>

                                        </div>


                                        <div class="input-field back-field-desactived">



                                            <button class="right detailButton details" name="id" value=<?= $p['id_publicacion'] ?>>Comentar</button>




                                        </div>

                                    </div>






                                </form>

                            </div>

                            <span>
                                Comentarios:

                                <?php




                                foreach ($count_comment as $c) {

                                    echo $c["count"];
                                }

                                ?>




                            </span>

                            <div class="card-comentarios">

                                <?php foreach ($comentarios as $c) { ?>

                                    <div class="card margin">

                                        <?php

                                        if ($c["id_user"] == $_SESSION['user']['id_usuario']) { ?>


                                            <form action="../controllers/EliminarComentario.php" method="GET">


                                                <a href="../controllers/EliminarComentario.php?id_post=<?= $c["id_publi"] ?>">
                                                    <button class="right deleteButton" name="id_elimComment" id="id_elimComment" value=<?= $c["id_comment"] ?>>
                                                        <i class="Small material-icons black-text">delete</i>

                                                    </button>
                                                </a>



                                            </form>

                                        <?php } ?>

                                        <div class="card-content parComent">

                                            <span class="right"> <?= $c["fecha"]  ?> </span>

                                            <p><?= $c['usuario'] ?></p>


                                            <span><?= $c['comentario'] ?></span>

                                        </div>


                                    </div>

                                <?php } ?>

                            </div>

                        </div>


                    </div>



                <?php } ?>


            </div>


        </div>



    <?php } else { ?>





    <?php } ?>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


</html>