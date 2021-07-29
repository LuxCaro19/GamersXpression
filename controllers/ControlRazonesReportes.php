<?php

namespace controllers;

use models\Reporte as Reporte;

require_once("../models/Reporte.php");

class ControlRazones
{

    public function __construct()
    {

    }

    public function listaRazones(){
        $reporte = new Reporte;
        $data = $reporte->buscarRazones();
        echo json_encode($data);   
        
    }

}

$obj=new ControlRazones();
$obj->listaRazones();

