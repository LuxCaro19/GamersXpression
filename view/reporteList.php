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
    if (isset($_SESSION['user']) && $_SESSION['user']['id_tipo_usuario'] == 1) { ?>




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
                        <li class="active"><a>Ver Reportes</a></li>
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

            <li><a href="Publicaciones.php"><i class="material-icons white-text">fiber_new</i>Publicaiones</a></li>
            <li><a href="verMisPublicaciones.php"><i class="material-icons white-text">account_box</i>Mis Publicaciones</a></li>
            <li><a href="videojuegosList.php"><i class="material-icons white-text">games</i>Ver Videojuegos</a></li>
            <li><a href="cerrarSesion.php"><i class="material-icons white-text">power_settings_new</i>Cerrar Sesión</a></li>
            <br>
            <h6 class="white-text center">Moderador</h6>
            <?php if ($_SESSION['user']['id_tipo_usuario'] == 1) { ?>
                <li class="active"><a href="reporteList.php"><i class="material-icons white-text">report_problem</i>Ver Reportes</a></li>
            <?php } ?>

        </ul>

        <div class="container">

            <div class="row" id="reportes">


                <div class="col l12 m12 s12">
                    <div class="card">

                        <div class="card-content center">
                            <h3>Gestion De Reportes</h3>


                            <div class="row">
                                <div class="col s12">
                                    <ul class="tabs">
                                        <li class="tab col s3"><a class="active indigo-text text-darken" href="#com" v-on:click="cargarReportes(1)">Comentarios</a></li>
                                        <li class="tab col s3"><a href="#pub" v-on:click="cargarReportes(2)" class="indigo-text text-darken">Publicaciones</a></li>
                                    </ul>
                                </div>
                                <div id="com" class="col s12">
                                    <!-- Aqui se cargan todos los reportes almacenados en reportesC -->
                                    <table class="table table-striped table-bordered centered" v-if="reportesC.length>0">
                                        <thead>
                                            <tr>
                                                <th>Razon</th>
                                                <th>fecha</th>
                                                <th>Reportado por</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(reporte, index) in reportesC">
                                                <td>{{reporte.razon}}</td>
                                                <td>{{reporte.fecha}}</td>
                                                <td>{{reporte.nombre}}</td>
                                                <td>
                                                    <a class="btn-floating btn-small waves-effect waves-light blue modal-trigger" href="#verCom" v-on:click="verDetalles(1,reporte.id_comentario,index)"><i class="material-icons">visibility</i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h4 v-else>
                                        <div class="alert-danger">
                                            No existen comentarios reportados actualmente
                                        </div>

                                    </h4>

                                </div>
                                <div id="pub" class="col s12">
                                    <!-- Aqui se cargan todos los reportes almacenados en reportesP -->

                                    <table class="table table-striped table-bordered" v-if="reportesP.length>0">
                                        <thead>
                                            <tr>
                                                <th>Razon</th>
                                                <th>fecha</th>
                                                <th>Reportado por</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(reporte, index) in reportesP">
                                                <td>{{reporte.razon}}</td>
                                                <td>{{reporte.fecha}}</td>
                                                <td>{{reporte.nombre}}</td>
                                                <td>
                                                    <a class="btn-floating btn-small waves-effect waves-light blue modal-trigger" href="#verPub" v-on:click="verDetalles(2,reporte.id_publicacion,index)"><i class="material-icons">visibility</i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h4 v-else>
                                        <div class="alert-danger">


                                            No existen publicaciones reportadas actualmente

                                        </div>
                                    </h4>

                                </div>


                            </div>



                        </div>
                    </div>
                </div>


                <div id="eliminar" class="modal">
                    <div class="modal-content">
                        <h4>ELIMINAR USUARIO</h4>
                        <p>Esta accion eliminara al usuario incluyendo las publicaciones, comentarios y valoraciones, ¿REALMENTE ESTAS SEGURO?</p>
                        <p> <Button class="btn-large pulse red modal-close" v-on:click="ejecutarAccion(3,usrSeleccionado)">SI</Button> <BUtton class="btn-large modal-close">NO</BUtton></p>
                    </div>
                </div>
                <div id="verCom" class="modal">
                    <div class="modal-content">
                        <h4 class="center">Detalles de comentario</h4>
                        <p>Reportado por : {{reportadoPor}}</p>
                        <p>Razon : {{razonSel}}</p>
                        <p>Detalles: {{detallesSel}}</p>
                        <div class="row">
                            <div class="col m1">
                                <a class="btn-floating waves-effect tooltipped pulse red" data-position="left" data-tooltip="Eliminar Comentario" href="#!" v-on:click="realizarAccion(2,reportesC[reporteSel].id_comentario,1)"><i class="material-icons">delete_forever</i></a> <BR></BR>
                                <a class="btn-floating waves-effect tooltipped pulse red" data-position="left" data-tooltip="Bloquear Usuario" href="#!" v-on:click="realizarAccion(1,reportesC[reporteSel].id_usuario,1)"><i class="material-icons">block</i></a> <br> </BR>
                                <a class="btn-floating waves-effect tooltipped pulse yellow" data-position="left" data-tooltip="Descartar Reporte" href="#!" v-on:click="realizarAccion(4,reportesC[reporteSel].id_report_comentario,1)"><i class="material-icons">highlight_off</i></a>
                            </div>

                            <div class="parComent col m11 card">
                                <div class="card-content">
                                    <span class="right">{{comSeleccionado.fecha}}</span>

                                    <p>{{comSeleccionado.usuario}}</p>


                                    <span>{{comSeleccionado.comentario}}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="verPub" class="modal">
                    <div class="modal-content">
                        <h4>Detalles de publicacion</h4>

                        <p>Reportado por : {{reportadoPor}}</p>
                        <p class="right">Razon : {{razonSel}}</p>
                        <p>Detalles: {{detallesSel}}</p>
                        <div class="row">
                            <div class="col m1">
                                <a class="btn-floating waves-effect tooltipped pulse red" data-position="left" data-tooltip="Eliminar Publicacion" href="#!" v-on:click="realizarAccion(3,reportesP[reporteSel].id_publicacion,2)"><i class="material-icons">delete_forever</i></a> <BR></BR>
                                <a class="btn-floating waves-effect tooltipped pulse red" data-position="left" data-tooltip="Bloquear Usuario" href="#!" v-on:click="realizarAccion(1,reportesP[reporteSel].id_usuario,2)"><i class="material-icons">block</i></a> <br> </BR>
                                <a class="btn-floating waves-effect tooltipped pulse yellow" data-position="left" data-tooltip="Descartar Reporte" href="#!" v-on:click="realizarAccion(5,reportesP[reporteSel].id_report_publicacion,2)"><i class="material-icons">highlight_off</i></a>
                            </div>
                            <div class="col m11 card">

                                <div class="card-content">
                                    <div class="row">

                                        <div class="col m10 s12">
                                            <h4>{{pubSeleccionada.titulo}}</h4>
                                            <span>Publicado por {{pubSeleccionada.usuario}}</span>
                                            <p>{{pubSeleccionada.contenido}}</p>
                                        </div>
                                        <div class="col m2 s12">
                                            <span class="right">fecha: {{pubSeleccionada.fecha}}</span>
                                            <span class="right">Videojuego: {{pubSeleccionada.juego}}</a></span>
                                        </div>
                                        <div class="card-image" v-if="pubSeleccionada.imgPublic">
                                            <img :src="`data:image/png;base64,${pubSeleccionada.imgPublic}`" class="materialboxed" v-bind:data-caption="pubSeleccionada.titulo" width="5" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l12 m12 s12">

                    <ul class="pagination">
                        <li class="waves-effect"><a href="#" v-on:click="paginar(-1)"><i class="material-icons">chevron_left</i></a></li>
                        <li v-for="item in listapaginas" v-bind:class="item.clase">
                            <a href="#" v-on:click="irApagina(item.pagina)">{{item.pagina+1}}</a>
                        </li>
                        <li class="waves-effect"><a href="#" v-on:click="paginar(+1)"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </div>

            </div>

        </div>




    <?php } else { ?>



        <?php

        header("Location: errorScreen.php");

        ?>



    <?php } ?>




</body>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="../js/listarReportes.js"></script>

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