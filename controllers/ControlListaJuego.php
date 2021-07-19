<?php

namespace controllers;

use models\Videojuego as Videojuego;

require_once("../models/Videojuego.php");



class ControlListaVideojuego
{
    public $busqueda;
    public $pagina;
    public $cantidad;

    public function __construct()
    {
        if (isset($_POST['busqueda'])) { $this->busqueda = $_POST['busqueda'];} else {$this->busqueda ="";}
        if (isset($_POST['pagina'])) { $this->pagina = $_POST['pagina'];} else {$this->pagina =0;}
        $this->cantidad = 4;
    }

    public function listarVideojuego(){

        $juego = new Videojuego();

        
        $total = $juego->contarBusquedaVideojuegos($this->busqueda);   
        $this->pagina = $this->pagina * $this->cantidad;
        $juegos = $juego->buscarVideojuegos($this->busqueda, $this->pagina, $this->cantidad);
        foreach ($juegos as &$value) {
            $value['imagen']= base64_encode($value['imagen']);
        }
        $data[0]=$juegos;
        $data[1]=intval($total[0]['cantidad']);
        $data[2]=$this->cantidad;
        echo json_encode($data);
    }
    

}

$obj=new ControlListaVideojuego();
$obj->listarVideojuego();

