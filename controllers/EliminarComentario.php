<?php

namespace controllers;

use models\Comentarios as Comentarios;

require_once("../models/Comentarios.php");

class EliminarComentario{

    public $id_post;
    public $id_delComment;
    


    public function __construct()
    {

        $this->id_post= $_GET['id_post'];
        $this->id_delComment= $_GET['id_elimComment'];
        
    }





    public function deleteComentario(){

        session_start();

        $objeto = new Comentarios();
        $count=$objeto->eliminarComentario($this->id_delComment);

        if($count==1){

            header("Location: ../view/detallePublicacion.php?id=".$this->id_post);

        }else{

            echo "hubo un error";

        }



    }



}

$obj=new EliminarComentario();
$obj->deleteComentario();