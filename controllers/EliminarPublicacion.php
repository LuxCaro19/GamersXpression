<?php

namespace controllers;

use models\Publicacion as Publicacion;

require_once("../models/Publicacion.php");

class EliminarPublicacion{

    
    public $id_del;



    public function __construct()
    {

        $this->id_del= $_POST['id_elim'];
    }





    public function deletePublicacion(){

        session_start();

        $objeto = new Publicacion();
        $count=$objeto->eliminarPublicacion($this->id_del);

        if($count==1){

            $mensaje = ["msg"=>"publicacion eliminada"];
                echo json_encode($mensaje);
        }else{

            $mensaje = ["msg"=>"No se ha podido eliminar la publicacion"];
            echo json_encode($mensaje);
        }



    }



}

$obj=new EliminarPublicacion();
$obj->deletePublicacion();