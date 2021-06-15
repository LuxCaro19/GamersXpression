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

        $this->id_public=$_POST['id_public'];
        $this->coment=$_POST['comentario'];
        $this->fecha = date('Y-m-d H:i:s');
        
    }

    

    
    public function publicarComentario(){

        session_start();

        $id_user=$_SESSION["user"]["id_usuario"];
        

        $model= new Comentarios();

        if($this->coment==""){


            $_SESSION ['error'] = "Realice un comentario";
            header("Location: ../view/detallePublicacion.php");

            $_SESSION['id_public']=$this->id_public;
            

        }else{


            $count= $model->crearComentario($this->coment, $this->fecha,$this->id_public,$id_user);

        }

       


        if($count==1){


            header("Location: ../view/detallePublicacion.php");

            $_SESSION['id_public']=$this->id_public;
            

        }else{

            echo "Hubo un error";

        }
        
        


    }

}

$obj= new ControlComentario();
$obj->publicarComentario();