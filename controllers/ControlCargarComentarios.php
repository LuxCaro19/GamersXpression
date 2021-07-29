<?php

namespace controllers;

use models\Comentarios as Comentarios;

require_once("../models/Comentarios.php");

class ControlCargarComentario{

    public $id;

    public function __construct()
    {

        $this->id=$_POST['id'];     
        
    }
    public function cargarComentarios(){
      
        $comentario = new Comentarios(); 
        //carga la lista de comentarios
        $data = $comentario->cargarComentarios($this->id);
        echo json_encode($data);
        
    }
    

}

$obj=new ControlCargarComentario();
$obj->cargarComentarios();

