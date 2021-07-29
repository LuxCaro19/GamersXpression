<?php

namespace controllers;

use models\Reporte as Reporte;
use models\Usuario as Usuario;
use models\Comentarios as Comentarios;
use models\Publicacion as Publicacion;

require_once("../models/Reporte.php");
require_once("../models/Usuario.php");
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
        //dependiendo si la accion realiza cierta accion
        switch ($this->accion) {
            case 1:
                //este caso es en caso de que moderador decida deshabilitar al usuario
                $usr = new Usuario;
                //ejecuta la funcion para cambiar el usuario
                $accion = $usr->cambiarEstado($this->id,'DESHABILITADO');
                //devuelve el mensaje dependiendo si se realizao o no la accion
                if ($accion) {
                    $mensaje = ["msg"=>"se ha bloqueado al usuario"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"no se ha podido bloquear al usuario"];
                    echo json_encode($mensaje); 
                }
                break;
            case 2:
                //este caso es cuando el moderador decide eliminar un comentario
                $com = new Comentarios;
                $contar = $com->eliminarComentario($this->id);
                if ($contar) {
                    $mensaje = ["msg"=>"se borrado el comentario"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"no se ha podido eliminar el comentario"];
                    echo json_encode($mensaje);
                }
                break;
            case 3:
                //este caso es cuando el moderador decide eliminar una publicacion
                $pub = new Publicacion;
                $contar = $pub->eliminarPublicacion($this->id);
                if ($contar) {
                    $mensaje = ["msg"=>"se borrado la publicacion"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"no se ha podido eliminar la publicacion"];
                    echo json_encode($mensaje);
                }
                break;
                
            case 4:
                //en esta cose el moderador decide eliminar un reporte de comentario
                $rep = new Reporte;
                $contar = $rep->eliminarReporteComentario($this->id);
                if ($contar) {
                    $mensaje = ["msg"=>"se ha borrado el comentario"];
                    echo json_encode($mensaje);
                } else {
                    $mensaje = ["msg"=>"no se ha podido eliminar el comentario"];
                    echo json_encode($mensaje);
                }
                break;     
            case 5:
                //en esta cose el moderador decide eliminar un reporte de publicacion
                $rep = new Reporte;
                $contar = $rep->eliminarReportePublicacion($this->id);
                if ($contar) {
                    $mensaje = ["msg"=>"se ha borrado la publicacion"];
                    echo json_encode($mensaje);
                } else {
                    $mensaje = ["msg"=>"no se ha podido eliminar la publicacion"];
                    echo json_encode($mensaje);
                }
                break;                        
            default:
                //este mensaje es en caso de que la accion no se haya establecido
                $mensaje = ["msg"=>"parametro de accion incorrecto"];
                echo json_encode($mensaje); 
                break;
        }
       
    }
}

$obj = new ControlDetalles();
$obj->cargarDetalle();
