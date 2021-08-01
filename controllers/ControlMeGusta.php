<?php

namespace controllers;

use models\MeGusta as MeGusta;

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

        $lk = new MeGusta();
        //busca si existe un me gusta
        $count=$lk->BuscarEspecifico($this->usuario,$this->publicacion);
        //si existe, elimina el me gusta, si no existe crea un me gusta
        if($count){
            $borrar=$lk->EliminarMeGusta($this->usuario,$this->publicacion);

            if ($borrar) {
                $mensaje = ["msg"=>"Ya no te gusta"];
                    echo json_encode($mensaje);
            } else {
                $mensaje = ["msg"=>"error al quitar me gusta"];
                    echo json_encode($mensaje);
            }    
        }else{
            $crear=$lk->CrearMeGusta($this->usuario,$this->publicacion);
            if ($crear) {
                $mensaje = ["msg"=>"te gusta esta publicacion"];
                echo json_encode($mensaje);
            } else {
                $mensaje = ["msg"=>"no se ha crear tu me gusta"];
                    echo json_encode($mensaje);
            }
        }      
    }

}

$obj=new ControlMeGusta();
$obj->crearMeGusta();
