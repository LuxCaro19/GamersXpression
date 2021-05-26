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
</head>

<body background="img/IndexBack.jpg">



    <div class="container">


        <div class="row login">

            <div class="col l12">


                <div class="col l4 m6 s12 offset-l4">


                    <div class="card">


                        <form action="controllers/Registrarse.php" method="POST">

                            <div class="card-content">

                                <h4 class="center">Registrate</h4>

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

                                    <input type="text" name="correoUsuario" id="correo">
                                    <label for="nombre">Correo</label>

                                </div>

                                <div class="input-field">

                                    <input type="text" name="nombreUsuario" id="nombre">
                                    <label for="clave">Nombre</label>


                                </div>

                                <div class="input-field">

                                    <input type="password" name="claveUsuario" id="clave">
                                    <label for="clave">Contraseña</label>


                                </div>

                                <div class="input-field center-align back-field-desactived">

                                    <button class="btn-large">Registrarse</button>




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