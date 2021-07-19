<?php


session_start();

use models\Videojuego as Videojuego;


require_once("../models/Videojuego.php");


$juego = new Videojuego(); 
//obtiene una lista con los juegos que tengan el id  obtenido
//guarda el primer elemento del arreglo obtenido (ya que el resultado es 1  o ninguno, se guarda el elemento fuera de la lista)
$detallesjuego = $juego->cargarDetalleVideojuego($_GET['id_juego'])[0];
//si existe una secuela, guarda los datos de la secuela
if (isset( $detallesjuego["id_juego_secuela"])) {$detallesSecuela = $juego->cargarDetalleVideojuego( $detallesjuego["id_juego_secuela"])[0];}
$star = '';
for ($i=0; $i < 5; $i++) {
    if (($detallesjuego["calificacion"]-$i) >= 0.5 && ($detallesjuego["calificacion"]-$i) < 1) { $star = $star.'<i class="fas fa-star-half-alt"></i>';}
    if (($detallesjuego["calificacion"]-$i) < 0.5) { $star = $star.'<i class="far fa-star"></i>';}
    if (($detallesjuego["calificacion"]-$i) >= 1) { $star = $star.'<i class="fas fa-star"></i>';}
}


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
    <script src="https://kit.fontawesome.com/c94741b33b.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    if (isset($_SESSION['user'])) { ?>
        <nav>

            <div class="nav-wrapper indigo darken-4">


                <img src="../img/Logo.png" alt="">
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">

                    <li><a href="VideojuegosList.php">Ver Videojuegos</a></li>
                    <li><a href="Publicaciones.php">Ver Publicaciones</a></li>
                    <li><a href="verMisPublicaciones.php">Mis Publicaciones</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                    <li><a><span class="white-text tam">
                                <<-| Usuario: <?= $_SESSION['user']['nombre'] ?> |->>
                            </span></a></li>

                </ul>

            </div>
        </nav>


        <div class="container">

            <div class="row view-publicacion">

                <div class="card">
                    
                    <div class="card-content">
                           
                        <div class="row">
                            <div class="col m4">
                                <div class="card">
                                    <div class="card-image ">
                                        <?= '<img class = "" src="data:image/jpeg;base64,' . base64_encode($detallesjuego['imagen']) . '"/>' ?>
                                    </div>
                                    <div class="card-content">
                                        
                                        <p>calificacion: <?= $detallesjuego["calificacion"].' '.$star  ?></p>
                                        <p>categoria : <?= $detallesjuego["categoria"]  ?></p>
                                        <p>año : no hay ano </p>
                                        <p>desarrollador : <?= $detallesjuego["cnombre"]  ?></p>
                                        <p>secuela : <?php if (isset( $detallesjuego["id_juego_secuela"])) {?> <a href="?id_juego=<?=$detallesjuego["id_juego_secuela"]?>"><?php } ?><?php if (isset( $detallesjuego["id_juego_secuela"])) {echo $detallesSecuela["nombre"];} else {echo "no existe secuela";} ?></a></p>

                                    </div>
                                </div>

                            </div>
                            <div class="col m8">
                                <h5 class="center"><?= $detallesjuego["nombre"]  ?></h5>
                                <p><?= $detallesjuego["historia_resumida"]  ?></p>

                                <h6 class="center"> Califica este juego</h6>
                                <form action="../controllers/ControlCalificar.php" method="POST">
                                    <input type="hidden" name="juego" value="<?=$detallesjuego["id_juego"]?>">
                                    <p class="center">
                                        <?php for ($i=0; $i < 5; $i++) { 
                                            if ($detallesjuego["usrcalificacion"] > $i){
                                                echo '<button  class="waves-effect waves-teal btn-flat" name="calificacion" value="'.($i+1).'" ><i class="fas fa-star"></i></button >';
                                            } else {
                                                echo '<button  class="waves-effect waves-teal btn-flat" name="calificacion" value="'.($i+1).'" ><i class="far fa-star"></i></button >';
                                            }

                                        } ?>
                                    </p>
                                </form>
                                <?php if (isset( $detallesjuego["usrcalificacion"])) {?> <h6 class="center"> tu calificacion <?= $detallesjuego["usrcalificacion"]?></h6><?php } ?>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>


        </div>



    <?php } else { ?>





    <?php } ?>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


</html>