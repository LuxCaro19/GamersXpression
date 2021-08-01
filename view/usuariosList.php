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
    if (isset($_SESSION['user'])&&$_SESSION['user']['id_tipo_usuario'] == 2) { ?>



        <nav>

            <div class="nav-wrapper indigo darken-4">


                <img src="../img/Logo.png" alt="">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <?php if ($_SESSION['user']['id_tipo_usuario']==2){?>
                    <li><a href="crearJuego.php">Nuevo Juego</a></li>
                    <li class="active"><a href="usuariosList.php">Administrar Usuarios</a></li>
                    <?php } ?>
                
                    <?php if ($_SESSION['user']['id_tipo_usuario']==1){?>
                    <li><a href="reporteList.php">Ver Reportes</a></li>
                    <?php } ?>
                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
                    <li class="active"><a href="verMisPublicaciones.php">Mis Publicaciones</a></li>
                    <li><a href="videojuegosList.php">Ver Videojuegos</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                    <li><a><span class="white-text tam">
                                <<-| Usuario: <?= $_SESSION['user']['nombre'] ?> |->>
                            </span></a></li>

                </ul>

            </div>
        </nav>

        <div class="container">

            <div class="row" id="usuarios">
 
               
                <div class="col l12 m12 s12">
                    <div class="card" >
                        
                        <div class="card-content">
                        <h3>Gestion de usuarios</h3>
                             

                            <div class="row">
                            
                            <!-- Este es el formulario de busqueda de udusarios -->
                                <div class="col m11 s12">
                                    <div class="input-field per">
                                        <input type="text" v-model="busquedadalsa">
                                        <label for="">Busca un usuario</label>
                                    </div>
                                </div>
                                <div class="col m1 s12">
                                    <div class="input-field back-field-desactived">
                                        <a class="btn-floating center-text" v-on:click="buscarJuego" >
                                        <i class="material-icons center">search</i></a>
                                    </div>
                                </div>
                            

                             <!-- Aqui se cargan todos los usuarios almacenados en listausuarios -->

                                <div lass="col l12 m12 s12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Estado</th>
                                                <th>tipo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="usuario in usuarios" >
                                                <td>{{usuario.nombre}}</td>
                                                <td>{{usuario.correo}}</td>
                                                <td><a class="btn-floating btn-small waves-effect waves-light blue" v-on:click="ejecutarAccion(1,usuario.id_usuario)" ><i class="material-icons">autorenew</i></a>{{usuario.estado}} </td>
                                                <td><a class="btn-floating btn-small waves-effect waves-light blue" v-on:click="ejecutarAccion(2,usuario.id_usuario)"><i class="material-icons">autorenew</i></a>{{usuario.tipo}} </td>
                                                <td>
                                                <a class="btn-floating btn-small waves-effect waves-light red modal-trigger" href="#eliminar" v-on:click="mostrarmensaje(usuario.id_usuario)"><i class="material-icons">delete_forever</i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                           

                            
                        </div>
                    </div>
                </div>

               
                <div id="eliminar" class="modal">
                    <div class="modal-content">
                    <h4>ELIMINAR USUARIO</h4>
                    <p>Esta accion eliminara al usuario incluyendo las publicaciones, comentarios y valoraciones, ¿REALMENTE ESTAS SEGURO?</p>
                    <p> <Button class="btn-large pulse red modal-close" v-on:click="ejecutarAccion(3,usrSeleccionado)" >SI</Button>            <BUtton class="btn-large modal-close">NO</BUtton></p>
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



        <?php 
            
            header("Location: errorScreen.php");
            
            ?>

        

    <?php } ?>




</body>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="../js/listarUsuarios.js"></script>


</html>