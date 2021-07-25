<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");

class ControlLogin{
    public $correo;
    public $clave;

    public function __construct(){



        $this->correo    = $_POST['correoUsuario'];
        $this->clave  = $_POST['claveUsuario'];


    }

    public function inicioSesion(){
        session_start();

        //primero se valida si los datos ingresados estan vacios 
        if($this->correo == "" || $this->clave=="") {
            $_SESSION ['error'] ="Datos no ingresados";
            header("Location: ../index.php");
            return;
        }

        //si existen datos en ambos campos, se crea un objeto usuario y se busca si los datos conciden en la base de datos
        //en caso de que exista un usuario, se guardara en la variable array
        $usuario = new Usuario();
        $array = $usuario->login($this->correo, $this->clave);

        //si el usuario no existe, entonces creara una sesion de error
        if(count($array) == 0) {
            $_SESSION ['error'] ="Usuario o contraseña invalida";
            header("Location: ../index.php");
            return;
        }
        //el codigo siguiente solo se ejecuta en caso de que el usuario exista

        //dependiendo si el usuario esta habilitado o no, perimitira ingresar al sistema
        $sesion=$array[0];
        switch ($sesion["estado"]) {
            case "HABILITADO":

                //si el usuario esta habilitado, se procedera a comprobar el tipo de usuario y se le llevara a las diferentes secciones
                $_SESSION['user'] = $sesion;

                switch ($sesion["id_tipo_usuario"]) {
                   
                   //si el usuario es moderador
                    case "1":
                        //header("Location: ../view/publicaciones.php");
                        echo "usted es moderador";
                        break;
                    //si el usuario es un administrador
                    case "2":
                        //header("Location: ../view/viewBlock.php");
                        echo "usted es admin";
                        break;
                    //si el usuario es un usuario
                    case "3":
                        header("Location: ../view/Publicaciones.php");
                        break;
                    default:
                        //no se que podria ir aqui, quizas un  error o algo
                        $_SESSION ['error'] = "Usuario no encontrado.";
                        header("Location: ../index.php");
                        break;
                } 
                break;
            case "BLOQUEADO":
                header("Location: ../view/viewBlock.php");
                break;
            default:
                //no se que podria ir aqui, quizas un  error o algo
                $_SESSION ['error'] = "Usuario no encontrado.";
                header("Location: ../index.php");
                break;
        } 

       
        
        
        
    }

}

$obj = new ControlLogin();
$obj->inicioSesion();