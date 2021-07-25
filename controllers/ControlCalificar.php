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

        $this->juego = $_POST['id'];
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
                $mensaje = ["msg"=>"calificacion actualizada"];
                echo json_encode($mensaje); 
            } else {
                $mensaje = ["msg"=>"calificacion no se ha actualizado"];
                echo json_encode($mensaje);
            }

               
        }else{
            $crear=$ca->calificar($this->juego,$this->usuario,$this->calificacion);
            if ($crear) {
                $mensaje = ["msg"=>"se ha calificado un videojuego"];
                echo json_encode($mensaje); 
            } else {
                $mensaje = ["msg"=>"no se ha calificado un videojuego"];
                echo json_encode($mensaje); 
            }
            
        }      
    }

}

$obj=new ControlCalificar();
$obj->crearCalificacion();
