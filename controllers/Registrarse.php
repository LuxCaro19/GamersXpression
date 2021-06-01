<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");

class Registrarse
{

    public $correo;
    public $nombre;
    public $clave;

    public function __construct()
    {



        $this->correo = $_POST['correoUsuario'];
        $this->nombre = $_POST['nombreUsuario'];
        $this->clave  = $_POST['claveUsuario'];
    }

    public function registrarse()
    {
        session_start();
        if ($this->correo == "" || $this->nombre == "" || $this->clave == "") {
            $_SESSION['error'] = "Datos no ingresados";
            header("Location: ../registrarse.php");
            return;
        }
        //crearemos un objeto usuario y le daremos los datos ingresados
        $usuario = new Usuario();
        $data = ["correo" => $this->correo, "nombre" => $this->nombre, "contra" => $this->clave];

        //buscaremos si un el correo ingresado ya se encuentra registrado
        $existe = $usuario->BuscarUsuarioCorreo($this->correo);

        if (empty($existe)) {
            //si el correo proporcionado no se encuentra en el sistema, se intentara crear un nuevo usuario con los datos ingresados
            //la variable count se utilizara para saber si el usuario fue o no creado
            $count = $usuario->CrearUsuairo($data);

             //se comprueba si el usuario se creo exitosamente con un if
            if ($count == 0) {
                //en caso de que no se creara el usuario, retornara a la pagina de registro con una session de error
                $_SESSION['error'] = "No se pudo concretar el registro";
                header("Location: ../registrarse.php");
                return;
            } else {
                //en caso de que el usuario se cree exitosamente se procedera a logearse,
                $usuario = new Usuario();
                $array = $usuario->login($this->correo, $this->clave);
                $sesion = $array[0];

                //los usuarios registrados solo son de tipo "usuario", asi que se crea una session y se redirige a la seccion correspondiente
                $_SESSION['user'] = $sesion;
                header("Location: ../view/Publicaciones.php");
            }

        } else {
            

            //en caso de que el correo del usuario ya se encuentre registrado, deberia crear una session con una session de error
            $_SESSION['error'] = "El usuario ya se encuentra registrado";
            header("Location: ../registrarse.php");
            return;
        }


       



        
    }
}

$obj = new Registrarse();

$obj->Registrarse();
