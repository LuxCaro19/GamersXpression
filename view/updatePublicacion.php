<?php

use models\Videojuego as Videojuego;
use models\Publicacion as Publicacion;

require_once("../models/Videojuego.php");
require_once("../models/Publicacion.php");

$modelo = new Videojuego();
$videojuegos = $modelo->cargarAllVideojuegos();

$public = new Publicacion();
$publicDetail = $public->cargarPublicacionSeleccionada($_GET['id_edit']);


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

                    <?php if ($_SESSION['user']['id_tipo_usuario'] == 1) { ?>
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
            <br>
            
            <?php if ($_SESSION['user']['id_tipo_usuario'] == 2) { ?>
                <h6 class="white-text center">Administrador</h6>
                <li><a href="crearJuego.php"><i class="material-icons white-text">create</i>Nuevo Juego</a></li>
                <li><a href="usuariosList.php"><i class="material-icons white-text">person</i>Administrar Usuarios</a></li>
            <?php } ?>
            
            <?php if ($_SESSION['user']['id_tipo_usuario'] == 1) { ?>
                <h6 class="white-text center">Moderador</h6>
                <li class="active"><a href="reporteList.php"><i class="material-icons white-text">report_problem</i>Ver Reportes</a></li>
            <?php } ?>
        </ul>

        <?php foreach ($publicDetail as $p) { ?>

            <div class="container center">

                <div class="row cardRealizar-publicacion view-publicacion">

                    <div class="col l6 m6 s12 offset-l3 offset-m3">
                        <div class="card">

                            <form action="../controllers/EditarPublicacion.php" method="POST" enctype="multipart/form-data">

                                <div class="card-content">


                                    <h4 class="center">Edita tu publicacion</h4>

                                    <?php

                                    if (isset($_SESSION['error'])) { ?>
                                        <div class="alert-danger">

                                            <h6> <?php echo $_SESSION['error'];  ?></h6>

                                        </div>

                                    <?php unset($_SESSION['error']);
                                    }


                                    ?>

                                    <div class="input-field">

                                        <input class="black-text" type="text" name="titulo" id="titulo" value="<?= $p['titulo'] ?>">

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
                                        <textarea name="content" id="content" class=" materialize-textarea"><?= $p['contenido'] ?></textarea>


                                    </div>

                                    <div class="input-field center-align back-field-desactived">

                                        <button name="id_public" id="id_public" class="btn-large" value=<?= $p['id_publicacion'] ?>>Editar</button>




                                    </div>



                                </div>

                            </form>

                        </div>


                    </div>

                </div>
            </div>

        <?php } ?>

        </div>
        </nav>






    <?php } else { ?>



        <?php

        header("Location: errorScreen.php");

        ?>




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