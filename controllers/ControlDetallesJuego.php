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
        $this->id = $_POST['id'];
    }

    public function listarVideojuego(){
        session_start();
        //guarda el usuario actual en una variable
        $this->usuario = $_SESSION['user']['id_usuario'];
        $juego = new Videojuego();
        $nota = new Calificacion();
        //consulta todos los datos de un videojuego utilizando un id
        $juegos = $juego->cargarDetalleVideojuego($this->id);

        //si el juego tiene secuela. entonces carga tambien los datos de la secuela y agrega el id y el nombre de la secuela al arreglo para ser consultados por la vista
        if ($juegos[0]['id_juego_secuela']){
            $secuela = $juego->cargarDetalleVideojuego($juegos[0]['id_juego_secuela']);
            if ($secuela){
                $secuela = $secuela[0]['nombre'];
                $juegos[0]['nombre_secuela'] = $secuela;
            } else {
                $juegos[0]['nombre_secuela'] = "";
            }
        }
        
        //carga la calificacion del juego
        $cal = $nota->buscarCalificacionJuego($this->id)[0]['calificacion'];
        //busca la calificacion del usuario si existe
        $calusr = $nota->buscarCalificacion($this->id,$this->usuario);

        
        //si existe la calificacion del usuario entonces se guarda en una variable 
        //si no existe, se guarda un 0 
        if ($calusr){
            $calusr = $calusr[0]['calificacion'];
            $juegos[0]['calificacionusr']=$calusr;
        } else {
            $calusr[] = 0;
            $juegos[0]['calificacionusr']=$calusr;
        }
        
        //se codifica la imagen en base 64 para poder ser enviada como jobject a la vista
        //se agrega la calificacion del usuario al arreglo
        $juegos[0]['imagen']= base64_encode($juegos[0]['imagen']);
        $juegos[0]['calificacion']= $cal;
        
        
        echo json_encode($juegos[0]);
    }
    

}

$obj=new ControlListaVideojuego();
$obj->listarVideojuego();

