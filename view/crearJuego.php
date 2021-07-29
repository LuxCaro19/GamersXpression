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
                    <?php if ($_SESSION['user']['id_tipo_usuario']==2){?>
                    <li class="active" ><a href="crearJuego.php">Nuevo Juego</a></li>
                    <li><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['user']['id_tipo_usuario']==1){?>
                    <li ><a href="reporteList.php">Ver Reportes</a></li>
                    <?php } ?>
                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
                    <li><a href="verMisPublicaciones.php">Mis Publicaciones</a></li>
                    <li><a href="videojuegosList.php">Ver Videojuegos</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                    <li><a><span class="white-text tam">
                                <<-| Usuario: <?= $_SESSION['user']['nombre'] ?> |->>
                            </span></a></li>

                </ul>


                <div class="container center " id="formulario">

                    <div class="row">
                        <div class="col m8 s12 offset-m2">
                            <div class="card">

                                <div class="card-content">
                                    <div class="row">

                                        <h4 class="center">Crea un juego</h4>
                                        <div class="input-field col m12 s12">
                                            <input id="nombre" v-model="nombre" type="text" class="validate">
                                            <label for="nombre">Titulo Juego</label>
                                        </div>

                                        <div class="input-field col m12 s12">
                                            <textarea v-model="resumen" id="resumen" class="materialize-textarea"></textarea>
                                            <label for="resumen">Historia resumida</label>
                                        </div>

                                        <div class="input-field col m6 s12">
                                            <select v-model="com">
                                                <option value="" disabled>Desarrolladora</option>
                                                <option v-for="c in compania" v-bind:value="c.id_compania">
                                                    {{ c.nombre }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="input-field col m6 s12">
                                            <select v-model="gen">
                                                <option value="" disabled>Categoria</option>
                                                <option v-for="g in genero" v-bind:value="g.id_categoria">
                                                    {{ g.categoria}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="input-field col m12 s12">
                                            <select v-model="sec">
                                                <option value="" disabled>Juego secuela</option>
                                                <option v-for="s in secuela" v-bind:value="s.id_juego">
                                                    {{ s.nombre}}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="input-field file-field col m12">
                                            <div class="btn-floating" >
                                                <span><i class="material-icons">image</i></span>
                                                <input type="file" @change="processFile($event)"accept="image/png, image/gif, image/jpeg" >
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path" disabled type="text" placeholder="Sube una foto de portada" v-model="pathh">
                                            </div>          
                                        </div>
                                        <div class="input-field col m12">
                                            <a href="#!" class="btn" v-on:click="crearJuego">Ingresar videojuego</a>
                                        </div>

                                    </div>
                                </div>
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


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../js/crearJuego.js"></script>

</html>