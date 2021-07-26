<?php

namespace controllers;

use models\Videojuego as Videojuego;

require_once("../models/Videojuego.php");


class ControlVideojuego
{


    public $nombre;
    public $resumen;
    public $compania;
    public $categoria;
    public $secuela;
    public $imagen;
    public $tamImagen;



    public function __construct()
    {

        $this->nombre =     $_POST['nombre'];
        $this->resumen =    $_POST['resumen'];
        $this->compania =   $_POST['compania'];
        $this->categoria =  $_POST['categoria'];
        $this->secuela =    $_POST['secuela'];
        if (isset($_FILES['imagen'])) {
            $this->imagen = fopen($_FILES['imagen']['tmp_name'], 'r');
            $this->tamImagen = $_FILES['imagen']['size'];
        }
    }


    public function crearJuego()
    {   
        //valida los campos vacios
        if ($this->imagen == "" || $this->nombre == "" || $this->resumen == "" || $this->compania == "" || $this->categoria == "") {
            $mensaje = ["msg"=>"completa los campos obligatorios","ok"=>"no"];
            echo json_encode($mensaje); 
            return;
        }
        //valida el size de la imagen, si es menor que el que permite la base de datos
        if ($this->tamImagen>1048576){
            $mensaje = ["msg"=>"imagen demasiado grande, elige otra","ok"=>"no"];
            echo json_encode($mensaje); 
            return;
        }

        $objeto = new Videojuego();
        //genera una imagen con los el tamao y los datos de la imagen
        $binaryImg = fread($this->imagen, $this->tamImagen);
        //si existe una secuela, se crea el juego utilizando la secuela, si no existe entonces queda nulo y se utiliza una funcion diferente
        if ($this->secuela =="") {
            $count = $objeto->crearJuego($this->nombre, $this->resumen, $binaryImg, $this->compania, $this->categoria);
        } else {
            $count = $objeto->crearJuegoConSecuela($this->nombre, $this->resumen, $binaryImg, $this->compania, $this->categoria,$this->secuela);
        }
        //si se creo bien el juego, entonces manda el mensaje de ok, si no se creo bien el juego, devuelve un mensaje de error
        if ($count == 1) {
            $mensaje = ["msg"=>"se ha creado el juego","ok"=>"ok"];
            echo json_encode($mensaje); 
            return;
        } else {
            $mensaje = ["msg"=>"no se ha podido crear el juego","ok"=>"no"];
            echo json_encode($mensaje); 
            return;
        }
    }
}

$obj = new ControlVideojuego();
$obj->crearJuego();
