<?php


use models\Videojuego as Videojuego;

require_once("../models/Videojuego.php");

$modelo = new Videojuego();
$videojuegos = $modelo->cargarAllVideojuegos();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realiza tu publicacion</title>
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
                    <?php if ($_SESSION['user']['id_tipo_usuario'] == 2) { ?>
                        <li><a href="crearJuego.php">Nuevo Juego</a></li>
                        <li><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user']['id_tipo_usuario']==1){?>
                    <li><a href="reporteList.php">Ver Reportes</a></li>
                    <?php } ?>
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

        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="../img/bkg.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="../img/back-side.jpg"></a>



                    <a href="#name"><span class="white-text name"><?= $_SESSION['user']['nombre'] ?></span></a>



                </div>
            </li>
            <li><a href="Publicaciones.php" class="white-text"><i class="material-icons white-text">fiber_new</i>Publicaiones</a></li>
            <li><a href="verMisPublicaciones.php"><i class="material-icons white-text">account_box</i>Mis Publicaciones</a></li>
            <li><a href="videojuegosList.php"><i class="material-icons white-text">games</i>Ver Videojuegos</a></li>
            <li><a href="cerrarSesion.php"><i class="material-icons white-text">power_settings_new</i>Cerrar Sesión</a></li>
        </ul>


        <div class="container center">

            <div class="row cardRealizar-publicacion view-publicacion">

                <div class="col l6 m6 s12 offset-l3 offset-m3">
                    <div class="card">

                        <form action="../controllers/ContolPublicacion.php" method="POST" enctype="multipart/form-data">

                            <div class="card-content">


                                <h4 class="center">Realiza tu publicacion</h4>

                                <div class="input-field">

                                    <input class="black-text" type="text" name="titulo" id="titulo">
                                    <label for="nombre">Titulo</label>

                                </div>


                                <select name="juego" id="juego" class="browser-default">
                                    <option value="" disabled selected hidden>Selecciona un videojuego</option>
                                    <?php foreach ($videojuegos as $v) { ?>


                                        <option value=<?= $v["id_juego"] ?>><?= $v["nombre"] ?></option>



                                    <?php } ?>
                                </select>


                                <div class="input-image">
                                    <span class="red-text left">* subir imagen es opcional</span>
                                    <input class="black-text" type="file" name="imagen" id="imagen">

                                </div>

                                <div class="input-field">

                                    <span class="black-text left">¡Expresate, Deja fluir tus argumentos!</span>
                                    <textarea name="content" id="content" class=" materialize-textarea"></textarea>


                                </div>

                                <div class="input-field center-align back-field-desactived">

                                    <button name="id_user" id="id_user" class="btn-large" value=<?= $_SESSION['user']['id_usuario'] ?>>Publicar</button>

                                </div>



                            </div>

                        </form>

                    </div>


                </div>

            </div>
        </div>
        </div>
        </nav>






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

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var elems = document.querySelectorAll('select');
        var instances = M.Sidenav.init(elems);
        var instances = M.FormSelect.init(elems);
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>

</html>