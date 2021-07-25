<?php

namespace controllers;

use models\Videojuego as Videojuego;

require_once("../models/Videojuego.php");

class ControlCargarData
{

    public function cargarData(){
      
        $juego = new Videojuego(); 
        //carga la lista de categorias desarolladoras y juegos para ser mostradas
        $data[0] = $juego->cargarCreadores();
        $data[1] = $juego->cargarCategoria();
        //esta funcion solo carga el nombre y el id de los juegos para haorra ancho de banda
        $data[2] = $juego->cargarListaJuegos();
        //convierte el arreglo data en un objeto
        echo json_encode($data);
        
    }
    

}

$obj=new ControlCargarData();
$obj->cargarData();

