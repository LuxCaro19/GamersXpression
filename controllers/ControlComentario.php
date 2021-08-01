<?php

namespace controllers;

use models\Comentarios as Comentarios;

require_once("../models/Comentarios.php");

class ControlComentario{


    public $id_public;
    public $coment;
    public $fecha;

    public function __construct()
    {

        $this->id_public=$_POST['id'];
        $this->coment=$_POST['comentario'];
        $this->fecha = date('Y-m-d H:i:s');
        
        
    }

    

    
    public function publicarComentario(){

        session_start();

        $id_user=$_SESSION["user"]["id_usuario"];
        //aqui se genera un enlace a la publicacion 
        $codigo = "../view/detallePublicacion.php?id=".$this->id_public;

        $model= new Comentarios();

        if($this->coment==""){
            $mensaje = ["msg"=>"el comentario no puede estar vacio","ok"=>"no"];
            echo json_encode($mensaje); 
            return;
        }
        $count= $model->crearComentario($this->coment, $this->fecha,$this->id_public,$id_user);
        
        if($count==1){
            $mensaje = ["msg"=>"Se ha comentado la publicacion","ok"=>"si"];
            echo json_encode($mensaje); 
            
        }else{
            $mensaje = ["msg"=>"no se ha podido comentar","ok"=>"no"];
            echo json_encode($mensaje); 
        }
        
        


    }

}

$obj= new ControlComentario();
$obj->publicarComentario();