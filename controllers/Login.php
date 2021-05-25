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
        if($this->correo == "" || $this->clave=="") {
            $_SESSION ['error'] ="Datos no ingresados";
            header("Location: ../index.php");
            return;
        }
        $usuario = new Usuario();
    
        $array = $usuario->login($this->correo, $this->clave);

        //echo $this->correo, $this->clave;
        

        if(count($array) == 0) {
            $_SESSION ['error'] ="Usuario o contraseña invalida";
            
            header("Location: ../index.php");
            return;
        }else{

            header("Location: ../view/Publicaciones.php");

        }

        // $a = $array[0];

       
        
        
        
    }

}

$obj = new ControlLogin();
$obj->inicioSesion();