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
                    <?php if ($_SESSION['user']['id_tipo_usuario']==2){?>
                    <li><a href="crearJuego.php">Nuevo Juego</a></li>
                    <li><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>
                
                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
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

            <div class="row" id="busqueda">
 
                <!-- Este es el formulario de busqueda de juego -->

                <div class="col l12 m12 s12">
                    <div class="card" >
                        <div class="items-comentar">
                            <div class="input-field per">
                                <input type="text" v-model="busquedadalsa">
                                <label for="">Busca un videojuego en especifico</label>
                            </div>

                            <div class="input-field back-field-desactived">
                                <button class="right detailButton details" type="submit" v-on:click="buscarJuego" name="action">
                                    <i class="material-icons center">search</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aqui se cargan todos los juegos almacenados en listajuegos -->

                <div v-for="juego in juegos">
                    <div class="col l3 m4 s6">
                        <a v-on:click="irAJuego(juego.id_juego)" href="#">
                            <div class="card">
                                <div class="card-image gamebox">
                                    <img :src="`data:image/png;base64,${juego.imagen}`" class="gameimage"/>
                                </div>
                                <div class="card-content">
                                    <p class="truncate center">{{juego.nombre}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col l12 m12 s12">

                    <ul class="pagination">
                        <li class="waves-effect"><a href="#!" v-on:click="paginar(-1)"><i class="material-icons">chevron_left</i></a></li>
                        <li v-for="item in listapaginas" v-bind:class="item.clase">
                            <a href="#!"  v-on:click="irApagina(item.pagina)">{{item.pagina+1}}</a>
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




</body>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="../js/listarJuegos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>