<?php

namespace controllers;

use models\Publicacion as Publicacion;
use models\MeGusta as MeGusta;

require_once("../models/Publicacion.php");
require_once("../models/MeGusta.php");




class ControlListaPublicaciones
{
    public $id;

    public function __construct()
    {

        $this->id = $_POST['id'];

    }

    public function listarPublicaciones(){
        session_start();
        $megusta = new MeGusta;
        $publicacion = new Publicacion;
        //genera la busqueda y guarda los datos en una variable
        $publi = $publicacion->cargarPublicacionSeleccionada($this->id);
        //cuenta los likes y comentarios
        foreach ($publi as &$value) {
            //convierte la imagen a base64 para poder mostrarla
            $value['imgPublic']= base64_encode($value['imgPublic']);
            //cuenta los likes y los agrega al arreglo
            $value['likes']= $megusta->Buscar($value['id_publicacion'])[0]['total'];
            //cuenta los comentarios y los agrega al arreglo
            $value['coment']= $publicacion->commentCount($value['id_publicacion'])[0]['count'];
            //cuenta si le diste like
            $value['youlike']= count($megusta->BuscarEspecifico($_SESSION['user']['id_usuario'],$value['id_publicacion']));

        }
        //inserta datos extra como la cantidad de resultados de la busqueda y la cantidad que se muestra por pagina
        $data[0]=$publi[0];
        $data[1]=$_SESSION['user']['id_usuario'];
        //muestra los datos como jobject
        echo json_encode($data);   
        
    }

}

$obj=new ControlListaPublicaciones();
$obj->listarPublicaciones();

