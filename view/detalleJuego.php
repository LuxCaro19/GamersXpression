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
    <script src="https://kit.fontawesome.com/c94741b33b.js" crossorigin="anonymous"></script>
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
                    <li><a href="crearJuego.php">Nuevo Juego</a></li>
                    <li><a href="usuariosList.php">Administrar Usuarios</a></li>
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


        <div class="container">

            <div class="row view-publicacion">

                <div class="card" id="detalles">

                    <div class="card-content">

                        <div class="row">
                            <div class="col m4">
                                <div class="card">
                                    <div class="card-image" v-if="juegos.imagen">
                                        <img v-bind:src="'data:image/jpeg;base64,'+juegos.imagen" />
                                    </div>
                                    <div class="card-content">

                                        <p>calificacion: {{juegos.calificacion}}
                                            <i v-for="i in calificacionjuego" v-bind:class="i"></i>
                                        <p>categoria : {{juegos.categoria}}</p>
                                        <p>año : inserta anio en DB </p>
                                        <p>desarrollador : {{juegos.cnombre}}</p>
                                        <p v-if="juegos.id_juego_secuela"> <a v-bind:href="'?id_juego='+juegos.id_juego_secuela">{{juegos.nombre_secuela}}</a></p>

                                    </div>
                                </div>

                            </div>
                            <div class="col m8">
                                <h5 class="center">{{juegos.nombre}}</h5>
                                <p>{{juegos.historia_resumida}}</p>

                                <h6 class="center"> Califica este juego</h6>

                                <p class="center">
                                    <button v-for="(i, index) in calificacionusr" v-on:click="calificar(index)" class="waves-effect waves-teal btn-flat"><i v-bind:class="i"></i></button>
                                </p>




                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>



    <?php } else { ?>





    <?php } ?>



</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="../js/detalleJuego.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


</html>