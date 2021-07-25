<?php

namespace controllers;

use models\Gusta as Gusta;

require_once("../models/MeGusta.php");


class ControlMeGusta
{
    public $publicacion;
    public $usuario;
    

    public function __construct()
    {

        $this->publicacion = $_POST['id_publicacion'];

    }

    public function crearMeGusta(){
        session_start();
        //guarda al usuario actual en una variable
        $this->usuario = $_SESSION['user']['id_usuario'] ;

        $lk = new Gusta();
        //busca si existe un me gusta
        $count=$lk->BuscarEspecifico($this->usuario,$this->publicacion);
        //si existe, elimina el me gusta, si no existe crea un me gusta
        if($count){
            $borrar=$lk->EliminarMeGusta($this->usuario,$this->publicacion);
            if ($borrar) {
                echo "se borro";
            } else {
                echo "no se borro";
            }

            header("Location: ../view/Publicaciones.php");     
        }else{
            $crear=$lk->CrearMeGusta($this->usuario,$this->publicacion);
            if ($crear) {
                echo "se creo";
            } else {
                echo "no se creo";
            }
            header("Location: ../view/Publicaciones.php");
        }      
    }

}

$obj=new ControlMeGusta();
$obj->crearMeGusta();
