<?php

namespace controllers;

use models\Reporte as Reporte;

require_once("../models/Reporte.php");



class ControlListaReporte
{
    public $pagina;
    public $cantidad;
    public $accion;

    public function __construct()
    {
        if (isset($_POST['pagina'])) { $this->pagina = $_POST['pagina'];} else {$this->pagina =0;}
        if (isset($_POST['accion'])) { $this->accion = $_POST['accion'];} else {$this->accion =0;}
        $this->cantidad = 10;

    }

    public function listarReportes(){

        //para evitar tantos archivos, este controlador devuelve la lista de todos los reportes tanto de comentarios como de publicacions
        //si se define, puede buscar solo los reportes de comentarios o solo los reportes publicaciones
        //01 solo reportes comentarios, 2 solo reportes de publicaciones

        $reporte = new Reporte;
        //calcula las paginas necesarias para mostrar todos los reportes
        $this->pagina = $this->pagina * $this->cantidad;
        //agrega la cantidad de paginas que se muestran a la vez en el arreglo
        $data[2]=$this->cantidad;

        switch ($this->accion) {
            case 1:
                //cuenta la cantidad de usuarios que arrojara la busqueda
                $total = $reporte->contarBusquedaRepComentarios();   
                //realiza la busqueda y fuarda los usuarios en una variable
                $reportes = $reporte->buscarReportesComentarios($this->pagina, $this->cantidad);
                //juarda los usuarios, la cantidad de resultados y la cantidad de usuarios por paginas  en una variable
                $data[0]=$reportes;
                $data[1]=intval($total[0]['cantidad']);
                echo json_encode($data);
                break;

            case 2:
                //cuenta la cantidad de usuarios que arrojara la busqueda
                $total = $reporte->contarBusquedaRepPublicciones();   
                //realiza la busqueda y fuarda los usuarios en una variable
                $reportes = $reporte->buscarReportesPublicacion($this->pagina, $this->cantidad);
                //juarda los usuarios, la cantidad de resultados y la cantidad de usuarios por paginas  en una variable
                $data[0]=$reportes;
                $data[1]=intval($total[0]['cantidad']);
                echo json_encode($data);               
                break;

            default:
                //este mensaje es en caso de que la accion no se haya establecido
                $mensaje = ["msg"=>"envie el parametro 1 para cargar reportes de comentarios o 2 para cargar reportes de publicaciones"];
                echo json_encode($mensaje); 
        }
        
    }
    

}

$obj=new ControlListaReporte();
$obj->listarReportes();

