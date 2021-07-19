<?php

namespace controllers;

use models\Videojuego as Videojuego;
use models\Calificacion as Calificacion;

require_once("../models/Videojuego.php");
require_once("../models/Calificacion.php");



class ControlListaVideojuego
{
    public $id;
    public $usuario;

    public function __construct()
    {
        $this->id = $_GET['id'];
    }

    public function listarVideojuego(){
        session_start();
        $this->usuario = $_SESSION['user']['id_usuario'];
        $juego = new Videojuego();
        $nota = new Calificacion();
        $juegos = $juego->cargarDetalleVideojuego($this->id);

        if ($juegos[0]['id_juego_secuela']){
            $secuela = $juego->cargarDetalleVideojuego($juegos[0]['id_juego_secuela']);
            if ($secuela){
                $secuela = $secuela[0]['nombre'];
                $juegos[0]['nombre_secuela'] = $secuela;
            } else {
                $juegos[0]['nombre_secuela'] = "";
            }
        }
        
        $cal = $nota->buscarCalificacionJuego($this->id)[0]['calificacion'];
        
        $calusr = $nota->buscarCalificacion($this->id,$this->usuario);

        
            
        if ($calusr){
            $calusr = $calusr[0]['calificacion'];
            $juegos[0]['calificacionusr']= bcdiv($calusr, 1, 1);
        } else {
            $calusr[] = 0;
            $juegos[0]['calificacionusr']=$calusr;
        }
        
    
        $juegos[0]['imagen']= base64_encode($juegos[0]['imagen']);
        $juegos[0]['calificacion']= bcdiv($cal, 1, 1);
        
        
        echo json_encode($juegos[0]);
    }
    

}

$obj=new ControlListaVideojuego();
$obj->listarVideojuego();

