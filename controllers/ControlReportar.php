<?php

namespace controllers;

use models\Reporte;

require_once("../models/Reporte.php");


class ControlReportar
{
    public $id;
    public $accion;
    public $id_razon_report;
    public $descripcion;
    public $id_usuario;
    public $fecha;

    public function __construct()
    {
        $this->id = $_POST['id'];
        $this->accion = $_POST['accion'];
        $this->id_razon_report = $_POST['id_razon_report'];
        $this->descripcion = $_POST['descripcion'];
    }

    public function crearReporte(){

        //consulta si el reporte esta vacio
        if ($this->id_razon_report == '' || $this->descripcion == '' || $this->id =='')
        {
            $mensaje = ["msg"=>"completa todos los campos"];
            echo json_encode($mensaje); 
            return;
        }
        session_start();

        //guarda al usuario actual en una variable
        $this->id_usuario = $_SESSION['user']['id_usuario'] ;

        //guarda la fecha de hoy en una variable
        $this->fecha =  date("Y-m-d");
        $reporte = new Reporte;

        //crea un arreglo con los datos para generar un reporte
        $data =["razon"=>$this->id_razon_report,
        "id_con"=>$this->id,
        "descripcion"=>$this->descripcion,
        "id_usr"=>$this->id_usuario,
        "fecha"=>$this->fecha];

        switch ($this->accion) {
            case 1:
                //esta accion reporta un comentario
                $contar = $reporte->CrearReporteComentario($data);
                if ($contar) {
                    $mensaje = ["msg"=>"Se ha reportado la publicacion"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"No se ha podido reportar"];
                    echo json_encode($mensaje); 
                }      
                break;

            case 2:
                //esta accion reporta una publicacion
                $contar = $reporte->CrearReportePublicacion($data);
                if ($contar) {
                    $mensaje = ["msg"=>"Se ha reportado la publicacion"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"No se ha podido reportar"];
                    echo json_encode($mensaje); 
                }      
                break;

            default:
                //este mensaje es en caso de que la accion no se haya establecido
                $mensaje = ["msg"=>"ni idea que hacer, parametro accion no establecido"];
                    echo json_encode($mensaje); 
                
        }
    }

}

$obj=new ControlReportar();
$obj->crearReporte();
