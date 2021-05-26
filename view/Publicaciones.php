<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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

                    <li><a href="VideojuegosList.php">Ver Videojuegos</a></li>
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

                        <span class="right">Videojuego: <a href="#">GTA 6</a></span>
                        <h4>Titulo de publicacion</h4>
                        <span>Publicado por: <?=$_SESSION['user']['nombre']?></span>    
                        <span class="right">fecha 3/3/666</span>


                        <div class="contenido">

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Esse eum adipisci delectus alias repellat odit atque soluta
                                modi iste aliquam beatae corrupti facilis,
                                iure possimus sapiente quasi quidem quas similique.
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                Ex, cum tenetur nam laborum voluptate voluptatum perferendis nobis ratione enim iusto
                                vitae eligendi veritatis, blanditiis, earum autem exercitationem eius. Iusto, quia.

                            </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Esse eum adipisci delectus alias repellat odit atque soluta
                                modi iste aliquam beatae corrupti facilis,
                                iure possimus sapiente quasi quidem quas similique.</p>

                        </div>





                    </div>

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

</html>