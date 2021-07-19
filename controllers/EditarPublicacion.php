<?php

namespace controllers;

use models\Publicacion as Publicacion;

require_once("../models/Publicacion.php");


class EditarPublicacion{


    public $titulo;
    public $contenido;
    public $imagen;
    public $tamImagen;
    public $id_game;
    public $id_publicacion;



    public function __construct()
    {

        $this->titulo=$_POST['titulo'];
        $this->contenido=$_POST['content'];
        $this->imagen =fopen($_FILES['imagen']['tmp_name'],'r');
        $this->tamImagen = $_FILES['imagen']['size'];
        $this->id_game=$_POST['juego'];
        $this->id_publicacion=$_POST['id_public'];


    }


    public function editPublicacion(){
        session_start();

        $binaryImg=fread($this->imagen,$this->tamImagen);
        $objeto= new Publicacion();
        

        $count= $objeto->editarPublicacion($this->titulo, $this->contenido,$binaryImg, $this->id_game, $this->id_publicacion);

        if($count==1){

            header("Location: ../view/detallePublicacion.php?id=".$this->id_publicacion);


        }else{

            echo "hubo un error";

        }

    }


}

$obj = new EditarPublicacion();
$obj->editPublicacion();
