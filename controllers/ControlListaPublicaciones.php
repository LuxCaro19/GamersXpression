<?php

namespace controllers;

use models\Publicacion as Publicacion;
use models\MeGusta as MeGusta;

require_once("../models/Publicacion.php");
require_once("../models/MeGusta.php");




class ControlListaPublicaciones
{
    public $busqueda;
    public $pagina;
    public $cantidad;

    public function __construct()
    {
        //los carecteres de busqueda  ypagina son opcionales
        if (isset($_POST['busqueda'])) { $this->busqueda = $_POST['busqueda'];} else {$this->busqueda ="";}
        if (isset($_POST['pagina'])) { $this->pagina = $_POST['pagina'];} else {$this->pagina =0;}
        $this->cantidad = 15;
    }

    public function listarPublicaciones(){
        session_start();
        $megusta = new MeGusta;
        $publicacion = new Publicacion;
        //cuenta cuantos resultados arrojara la busqueda
        $total = $publicacion->contarPublicacionesJoin($this->busqueda);   
        //calcula cuantas paginas se necesitan para mostrar todos las publicaciones
        $this->pagina = $this->pagina * $this->cantidad;
        //genera la busqueda y guarda los datos en una variable
        $juegos = $publicacion->cargarPublicacionesJoin($this->busqueda, $this->pagina, $this->cantidad);
        //cuenta los likes y comentarios
        foreach ($juegos as &$value) {
            //cuenta los likes y los agrega al arreglo
            $value['likes']= $megusta->Buscar($value['id_publicacion'])[0]['total'];
            //cuenta los comentarios y los agrega al arreglo
            $value['coment']= $publicacion->commentCount($value['id_publicacion'])[0]['count'];
            //cuenta si le diste like
            $value['youlike']= count($megusta->BuscarEspecifico($_SESSION['user']['id_usuario'],$value['id_publicacion']));

        }
        //inserta datos extra como la cantidad de resultados de la busqueda y la cantidad que se muestra por pagina
        $data[0]=$juegos;
        $data[1]=intval($total[0]['cantidad']);
        $data[2]=$this->cantidad;
        //devuelve al usuario que realizo la busqueda
        $data[3]=$_SESSION['user']['id_usuario'];
        //muestra los datos como jobject
        echo json_encode($data);   
        
    }

}

$obj=new ControlListaPublicaciones();
$obj->listarPublicaciones();

