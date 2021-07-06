<?php

namespace controllers;

use models\Publicacion as Publicacion;

require_once("../models/Publicacion.php");


class ControlPublicacion
{


    public $titulo;
    public $contenido;
    public $imagen;
    public $megusta;
    public $fecha;
    public $id_game;
    public $id_usuario;
    public $id_del;



    public function __construct()
    {

        $this->titulo = $_POST['titulo'];
        $this->contenido = $_POST['content'];
        $this->imagen = $_POST['imagen'];
        $this->megusta = 0;
        $this->fecha = date('Y-m-d H:i:s');
        $this->id_game = $_POST['juego'];
        $this->id_usuario = $_POST['id_user'];
        $this->id_del= $_POST['id_delete'];
    }


    public function crearPublicacion(){
        session_start();


        $objeto = new Publicacion();
        $count=$objeto->crearPublicacion($this->titulo,$this->contenido,$this->fecha,$this->megusta,$this->id_game,$this->id_usuario);


        if($count==1){

            header("Location: ../view/verMisPublicaciones.php");
            

        }else{


            echo "hubo un error";

        }
        
        
        


    }

    

}

$obj=new ControlPublicacion();
$obj->crearPublicacion();