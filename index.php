<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamersXpression</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body background="img/IndexBack.jpg">

    <div class="container">


        <div class="row login">

            <div class="col l12">

                <div class="col l8 m6 s12">

                <h2 class="white-text">¿Qué es GamersXpression?</h2>
                <p class="white-text parrafoIndex">
                    Es una web dedicada para la comunidad Gamer, enfocada
                    en la critica, reseñas, opiniones y discuciones de Videojuegos,
                    como expresar molestias y posibles cambios que te gustaria que agregaran a tus
                    juegos. Esta Web es amplia, puedes encontrar diferentes opiniones de diferentes jugadores, 
                    aquí tu y todos pueden ser especialistas.
                </p>

                <h4 class="white-text">¡Disfruta la web y opina con la comunidad!</h4>

                <div class="col l4">
                
                <i class="medium material-icons white-text">add</i> 
                <p class="white-text center">
                
                Aprovecha las virtudes y hazle llamar tu atencion a las grandes compañias, haz oir tus quejas, haz oir tus deseos</p>

                </div>

                
                <div class="col l4">
                <i class="medium material-icons white-text">add</i> 

                <p class="white-text center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio quasi hic, omnis voluptates dolores a? Molestias praesentium ipsa accusantium dicta, qui velit eius non at animi, quod reprehenderit. Iusto, rem?</p>

                </div>

    
                <div class="col l4">
                <i class="medium material-icons white-text">add</i> 
                <p class="white-text center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste dolor, veniam at quisquam quibusdam quod facere nobis distinctio sequi quam doloribus illum sint ut nisi optio a? Iusto, eaque nihil!</p>

                </div>


                </div>

                

                <div class="col l4 m6 s12">


                    <div class="card">


                        <form action="controllers/Login.php" method="POST">

                            <div class="card-content">

                                <h4 class="center">Bienvenido a</h4>

                                <div class="imgLogin center">

                                    <img src="img/Logo.png" alt="300">


                                </div>

                                <div class="">

                                    <?php
                                    session_start();
                                    if (isset($_SESSION['error'])) { ?>

                                        <h6 class="center red-text text-darken"> <?php echo $_SESSION['error'];  ?></h6>

                                    <?php unset($_SESSION['error']);
                                    }

                                    ?>


                                </div>



                                <div class="input-field">

                                    <input type="text" name="correoUsuario" id="nombre">
                                    <label for="nombre">Correo</label>

                                </div>

                                <div class="input-field">

                                    <input type="password" name="claveUsuario" id="clave">
                                    <label for="clave">Contraseña</label>


                                </div>

                                <div class="input-field center-align back-field-desactived">

                                    <button class="btn-large">Iniciar Sesión</button>




                                </div>

                                <div class="center">

                                    <span>¿No tienes una cuenta? </span>

                                    <a href="registrarse.php">¡Registrate!</a>

                                    <p>¡Es gratis!</p>


                                </div>




                            </div>






                        </form>

                    </div>

                </div>
            </div>


        </div>

    </div>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</html>