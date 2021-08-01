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
                    <?php if ($_SESSION['user']['id_tipo_usuario'] == 2) { ?>
                        <li><a href="crearJuego.php">Nuevo Juego</a></li>
                        <li><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['user']['id_tipo_usuario'] == 1) { ?>
                        <li><a href="reporteList.php">Ver Reportes</a></li>
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
            <li class="active"><a href="Publicaciones.php" class="white-text"><i class="material-icons white-text">fiber_new</i>Publicaiones</a></li>
            <li><a href="verMisPublicaciones.php"><i class="material-icons white-text">account_box</i>Mis Publicaciones</a></li>
            <li><a href="videojuegosList.php"><i class="material-icons white-text">games</i>Ver Videojuegos</a></li>
            <li><a href="cerrarSesion.php"><i class="material-icons white-text">power_settings_new</i>Cerrar Sesión</a></li>
        </ul>

        <div class="container" id="publicaciones">

            <div class="view-publicacion">
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
            </div>

            <div v-if="publicaciones.length>0">


                <div v-for="(publicacion, index) in publicaciones">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">

                                <div class="col m10 s12">
                                    <h4>{{publicacion.titulo}}</h4>
                                    <span>Publicado por {{publicacion.usuario}}</span>
                                    <p>{{publicacion.contenido}}</p>
                                </div>
                                <div class="col m2 s12">
                                    <span class="right">fecha: {{publicacion.fecha}}</span>
                                    <span class="right">Videojuego: <a v-bind:href="'detalleJuego.php?id_juego='+publicacion.id_juego">{{publicacion.juego}}</a></span>
                                </div>
                                <div class="col m12">
                                    <hr>
                                    <a href="#!" class="btn-flat" v-on:click="like(publicacion.id_publicacion)"><i v-if="publicacion.youlike==0" class="material-icons">favorite_border</i><i v-else class="material-icons">favorite</i>{{publicacion.likes}}</a>
                                    <a href="#!" class="btn-flat"><i class="material-icons">comment</i>{{publicacion.coment}}</a>
                                    <a v-bind:href="'detallePublicacion.php?id='+publicacion.id_publicacion" class="btn-flat">Ver publicacion</a>
                                    <a v-if="usrActual==publicacion.id_usuario" v-on:click="alertDLT(publicacion.id_publicacion)" href="#!" data-tooltip="Borrar Publicacion" data-position="top" class="btn-flat right tooltipped"><i class="material-icons">delete</i></a>
                                    <a v-if="usrActual!=publicacion.id_usuario" v-on:click="alrtREP(publicacion.id_publicacion)" href="#!" data-tooltip="Reportar Publicacion" data-position="top" class="btn-flat right tooltipped"><i class="material-icons">error</i></a>
                                    <a v-if="usrActual==publicacion.id_usuario" v-bind:href="'updatePublicacion.php?id_edit='+publicacion.id_publicacion" data-tooltip="Editar Publicacion" data-position="top" class="btn-flat right tooltipped"><i class="material-icons">edit</i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="card">
                    <div class="card-content">
                        <h4>No has publicado nada por ahora, empieza escribiendo una opinion</h4>
                    </div>
                </div>
            </div>
            <div id="eliminar" class="modal">
                <div class="modal-content">
                    <h4>Eliminar Publicacion</h4>
                    <p>Esta accion eliminara tu publivacion, ¿REALMENTE ESTAS SEGURO?</p>
                    <p> <Button class="btn-large pulse red modal-close" v-on:click="eliminarPub(pubSeleccionada)">SI</Button> <BUtton class="btn-large modal-close">NO</BUtton></p>
                </div>
            </div>
            <div id="reportar" class="modal">
                <div class="modal-content">
                    <h4>Reportar Publicacion</h4>
                    <p>Indicanos cual es el problema con esta publicacion</p>
                    <input v-model="descripcion" type="text" placeholder="Describe tu problema aqui">
                    <div class="input-field col m12 s12">
                        <select v-model="raz">
                            <option value="" disabled>Razon de Reporte</option>
                            <option v-for="r in razones" v-bind:value="r.id_razon_report">
                                {{ r.razon}}
                            </option>
                        </select>
                    </div>
                    <p> <Button class="btn-large pulse red modal-close" v-on:click="reportarPub(pubSeleccionada)">Reportar esto</Button></p>
                </div>
            </div>
            <div class="col l12 m12 s12">
                <ul class="pagination">
                    <li class="waves-effect"><a href="#!" v-on:click="paginar(-1)"><i class="material-icons">chevron_left</i></a></li>
                    <li v-for="item in listapaginas" v-bind:class="item.clase">
                        <a href="#!" v-on:click="irApagina(item.pagina)">{{item.pagina+1}}</a>
                    </li>
                    <li class="waves-effect"><a href="#!" v-on:click="paginar(+1)"><i class="material-icons">chevron_right</i></a></li>
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


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../js/listarMisPublicaciones.js"></script>


</body>

</html>