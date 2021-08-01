<?php

namespace controllers;

use models\Comentarios as Comemtarios;
use models\Publicacion as Publicacion;

require_once("../models/Comentarios.php");
require_once("../models/Publicacion.php");


class ControlDetalles
{

    public function __construct()
    {

        $this->id =     $_POST['id'];
        $this->accion =    $_POST['accion'];
    }


    public function cargarDetalle()
    {   
        //dependiendo si la accion es 1 o 2 devolvera los detalles de un comentario o de una publicacion
        switch ($this->accion) {
            case 1:
                $com = new Comemtarios;
                $contar = $com->cargarComentarioEspecifico($this->id);
                if ($contar) {
                    echo json_encode($contar);
                } else {
                    $mensaje = ["msg"=>"no hay comentarios seleccionadas"];
                    echo json_encode($mensaje);
                }
                break;

            case 2:
                $pub = new Publicacion;
                $contar = $pub->cargarPublicacionSeleccionada($this->id);
                if ($contar) {
                    $contar[0]['imgPublic']= base64_encode($contar[0]['imgPublic']);
                    echo json_encode($contar);
                } else {
                    $mensaje = ["msg"=>"no hay publicaciones seleccionadas"];
                    echo json_encode($mensaje);
                }
                break;
            default:
                //este mensaje es en caso de que la accion no se haya establecido
                $mensaje = ["msg"=>"parametro accion incorrecto, 1 para detalles comntario, 2 para detalles publicacion"];
                echo json_encode($mensaje); 
                break;
        }
       
    }
}

$obj = new ControlDetalles();
$obj->cargarDetalle();
