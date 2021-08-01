<?php

namespace controllers;

use models\Publicacion as Publicacion;

require_once("../models/Publicacion.php");


class ControlPublicacion
{


    public $titulo;
    public $contenido;
    public $imagen = null;
    public $tamImagen = null;
    public $megusta;
    public $fecha;
    public $id_game;
    public $id_usuario;
    public $id_del;



    public function __construct()
    {

        $this->titulo = $_POST['titulo'];
        $this->contenido = $_POST['content'];
        if ($_FILES['imagen']['error'] == 0) {


            $this->imagen = fopen($_FILES['imagen']['tmp_name'], 'r');
            $this->tamImagen = $_FILES['imagen']['size'];
        }



        $this->megusta = 0;
        $this->fecha = date('Y-m-d H:i:s');
        $this->id_game = $_POST['juego'];
        $this->id_usuario = $_POST['id_user'];
        $this->id_del = $_POST['id_delete'];
    }


    public function crearPublicacion()
    {
        session_start();

        if ($this->imagen != null) {
            $binaryImg = fread($this->imagen, $this->tamImagen);
        } else {

            $binaryImg = null;
        }

        if($this->titulo==""){

            $_SESSION ['error'] = "Debe ingresar un titulo";
            header("Location: ../view/crearPublicacion.php");


        }else if($this->id_game==""){

            $_SESSION ['error'] = "Debe selecccionar un videojuego";
            header("Location: ../view/crearPublicacion.php");

        }else if($this->contenido==""){

            $_SESSION ['error'] = "Debe agregar contenido a la publicacion";
            header("Location: ../view/crearPublicacion.php");

        }else{


            $objeto = new Publicacion();
            $count = $objeto->crearPublicacion($this->titulo, $this->contenido, $this->fecha, $binaryImg, $this->megusta, $this->id_game, $this->id_usuario);


        }

        

        if ($count == 1) {

            header("Location: ../view/verMisPublicaciones.php");
        } else {


            echo "hubo un error";
        }
    }
}

$obj = new ControlPublicacion();
$obj->crearPublicacion();
