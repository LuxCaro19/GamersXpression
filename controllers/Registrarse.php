<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");

class Registrarse{

    public $correo;
    public $nombre;
    public $clave;

    public function __construct(){



        $this->correo = $_POST['correoUsuario'];
        $this->nombre = $_POST['nombreUsuario'];
        $this->clave  = $_POST['claveUsuario'];


    }

    public function registrarse(){
        session_start();
        if($this->correo == "" || $this->nombre=="" || $this->clave=="") {
            $_SESSION ['error'] ="Datos no ingresados";
            header("Location: ../registrarse.php");
            return;
        }


        $usuario = new Usuario();
    
        $data = ["correo"=>$this->correo,"nombre"=>$this->nombre,"contra"=>$this->clave];

        $count = $usuario->CrearUsuairo($data);

       /* echo $this->nombre, $this->correo, $this->clave;
        echo json_encode($data);*/

        //echo $this->correo, $this->clave;
        

        if($count == 0) {
            $_SESSION ['error'] ="No se pudo concretar el registro";
            
            header("Location: ../registrarse.php");
            return;
        }else{

            header("Location: ../view/Publicaciones.php");

        }

    }





}

$obj = new Registrarse();

$obj->Registrarse();