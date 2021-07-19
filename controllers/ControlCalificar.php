<?php

namespace controllers;

use models\Calificacion as Calificacion;

require_once("../models/Calificacion.php");


class ControlCalificar
{
    public $juego;
    public $usuario;
    public $calificacion;
    

    public function __construct()
    {

        $this->juego = $_POST['juego'];
        $this->calificacion = $_POST['calificacion'];

    }

    public function crearCalificacion(){
        session_start();
        $this->usuario = $_SESSION['user']['id_usuario'] ; 
        $ca = new Calificacion();
        $count=$ca->buscarCalificacion($this->juego,$this->usuario);

        if($count){
            
            $cambiar=$ca->editarCalificacion($this->calificacion,$count["0"]["id_calificacion"]);
            if ($cambiar) {
                echo "se cambio";
            } else {
                echo "no se cambio";
            }

            header("Location: ../view/detalleJuego.php?id_juego=".$this->juego);     
        }else{
            $crear=$ca->calificar($this->juego,$this->usuario,$this->calificacion);
            if ($crear) {
                echo "se califico";
            } else {
                echo "no se califico";
            }
            header("Location: ../view/detalleJuego.php?id_juego=".$this->juego);
        }      
    }

}

$obj=new ControlCalificar();
$obj->crearCalificacion();
