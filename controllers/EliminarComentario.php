<?php

namespace controllers;

use models\Comentarios as Comentarios;

require_once("../models/Comentarios.php");

class EliminarComentario{

    public $id;
    
    public function __construct()
    {
        $this->id= $_POST['id'];
    }





    public function deleteComentario(){


        $objeto = new Comentarios();
        $count=$objeto->eliminarComentario($this->id);

        if($count==1){
            $mensaje = ["msg"=>"Se ha eliminado el comentario","ok"=>"si"];
            echo json_encode($mensaje); 

        }else{

            $mensaje = ["msg"=>"no se ha podido eliminar el comentario","ok"=>"no"];
            echo json_encode($mensaje); 

        }



    }



}

$obj=new EliminarComentario();
$obj->deleteComentario();