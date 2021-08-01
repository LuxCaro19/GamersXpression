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


        <div class="container" id="pubDetlles">

            <div class="row view-publicacion">

                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col m12">
                                <span class="left btn-flat">Publicado por {{publicacion.usuario}}</span>
                                <span class="left btn-flat ">fecha: {{publicacion.fecha}} </span>
                                <span class="left btn-flat">Videojuego: <a v-bind:href="'detalleJuego.php?id_juego='+publicacion.id_juego">{{publicacion.juego}}</a></span>
                                <a v-if="usrActual==publicacion.id_user" v-on:click="alertDLT(publicacion.id_publicacion)" href="#!" data-tooltip="Borrar Publicacion" data-position="right" class="btn-flat right tooltipped"><i class="material-icons">delete</i></a>
                                <a v-if="usrActual!=publicacion.id_user" v-on:click="alrtREP(publicacion.id_publicacion)" href="#!" data-tooltip="Reportar Publicacion" data-position="right" class="btn-flat right tooltipped"><i class="material-icons">error</i></a>
                                <a v-if="usrActual==publicacion.id_user" v-bind:href="'updatePublicacion.php?id_edit='+publicacion.id_publicacion" data-tooltip="Editar Publicacion" data-position="right" class="btn-flat right tooltipped"><i class="material-icons">edit</i></a>
                            </div>

                            <div class="col m8 s12">
                                <h3>{{publicacion.titulo}}</h3>
                                <p>{{publicacion.contenido}}</p>
                            </div>
                            <div class="col m4 s12 card-image" v-if="publicacion.imgPublic">
                                <img class="materialboxed" v-bind:data-caption="publicacion.titulo" v-bind:src="'data:image/jpeg;base64,'+publicacion.imgPublic">
                            </div>
                            <div class="col m12 s12">
                                <hr>
                                <a href="#!" class="btn-flat" v-on:click="like(publicacion.id_publicacion)"><i v-if="publicacion.youlike==0" class="material-icons">favorite_border</i><i v-else class="material-icons">favorite</i>{{publicacion.likes}}</a>
                                <a href="#!" class="btn-flat" v-on:click="modoComentar()"><i class="material-icons">comment</i>{{publicacion.coment}}</a>
                            </div>
                            <div v-if="comentmode">
                                <div class="col m12 s12">

                                    <div class="card border-coment">
                                        <div class="row">
                                            <div class=" parComent card-content">

                                                <div class="input-field per col m10">
                                                    <input type="text" v-model="comentario">
                                                    <label for="nombre">Comenta esta publicacion</label>
                                                </div>
                                                <div class="input-field back-field-desactived col m2">
                                                    <button class="right detailButton" v-on:click="crearComentario">Comentar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col m12 s12">
                                <div class="card-comentarios">
                                    <div v-for="c in comentariosList" v-if="comentariosList.length>0">

                                        <div class="card">
                                            <div class=" parComent card-content">

                                                <a v-if="usrActual!=c.id_user" v-on:click="alrtREPCOM(c.id_comment)" href="#!" data-tooltip="Reportar Comentario" data-position="right" class="right btn-flat tooltipped"><i class="material-icons">error</i></a>

                                                <span class="right">{{c.fecha}}</span>

                                                <p>{{c.usuario}}</p>
                                                <span>{{c.comentario}}</span>



                                                <a v-if="usrActual==c.id_user" v-on:click="alertDLTCOM(c.id_comment)" href="#!" data-tooltip="Borrar Comentario" data-position="right" class="right btn-flat tooltipped"><i class="material-icons">delete</i></a> <br>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="comentariosList.length==0">
                                <div class="col m12 s12">
                                    <h5 class="center">Aun no hay comentarios, presiona el icono de comentarios para comentar</h5>
                                </div>
                            </div>

                            <div id="eliminar" class="modal">
                                <div class="modal-content">
                                    <h4>Eliminar Publicacion</h4>
                                    <p>Esta accion eliminara tu publicacion, ¿REALMENTE ESTAS SEGURO?</p>
                                    <p> <Button class="btn-large pulse red modal-close" v-on:click="eliminarPub(pubSeleccionada)">SI</Button> <BUtton class="btn-large modal-close">NO</BUtton></p>
                                </div>
                            </div>
                            <div id="reportar" class="modal">
                                <div class="modal-content">
                                    <h4>Reportar Publicacion</h4>
                                    <p>Indicanos cual es el problema con esta publicacion</p>
                                    <div class="input-field">
                                        <input v-model="descripcion" type="text" placeholder="Describe tu problema aquí">
                                    </div>
                                    <div class="input-field col m12 s12">
                                        <select v-model="raz">
                                            <option value="" disabled>Razón de Reporte</option>
                                            <option v-for="r in razones" v-bind:value="r.id_razon_report">
                                                {{ r.razon}}
                                            </option>
                                        </select>
                                    </div>
                                    <p class="center"> <Button class="btn-large pulse dark modal-close" v-on:click="reportarPub(2)">Reportar esto</Button></p>
                                </div>
                            </div>
                            <div id="eliminarC" class="modal">
                                <div class="modal-content">
                                    <h4 class="center">Eliminar Comentario</h4>
                                    <div class="alert-danger">
                                        ¿Realmente deseas eliminar este comentario?
                                    </div>
                                    <p class=""> <Button class="btn-large pulse red modal-close" v-on:click="eliminarCom(comSeleccionado)">SI</Button>
                                        <BUtton class="btn-large modal-close">NO</BUtton>
                                    </p>
                                </div>
                            </div>
                            <div id="reportarC" class="modal">
                                <div class="modal-content">
                                    <h4>Reportar Comentario</h4>
                                    <p>Indicanos cual es el problema con este comentario</p>
                                    <div class="input-field">
                                        <input v-model="descripcion" type="text" placeholder="Describe tu problema aquí">
                                    </div>
                                    <div class="input-field col m12 s12">
                                        <select v-model="raz">
                                            <option value="" disabled>Razón de Reporte</option>
                                            <option v-for="r in razones" v-bind:value="r.id_razon_report">
                                                {{ r.razon}}
                                            </option>
                                        </select>
                                    </div>
                                    <p class="center"> <Button class="btn-large pulse dark modal-close" v-on:click="reportarPub(1)">Reportar esto</Button></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php } else { ?>





            <?php } ?>



</body>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../js/detallePublicacion.js"></script>

</html>