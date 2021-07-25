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
        //los carecteres de busqueda  ypagina son opcionales
        if (isset($_POST['busqueda'])) { $this->busqueda = $_POST['busqueda'];} else {$this->busqueda ="";}
        if (isset($_POST['pagina'])) { $this->pagina = $_POST['pagina'];} else {$this->pagina =0;}
        $this->cantidad = 12;
    }

    public function listarVideojuego(){

        $juego = new Videojuego();

        //cuenta cuantos resultados arrojara la busqueda
        $total = $juego->contarBusquedaVideojuegos($this->busqueda);   
        //calcula cuantas paginas se necesitan para mostrar todos los juegos
        $this->pagina = $this->pagina * $this->cantidad;
        //genera la busqueda y guarda los datos en una variable
        $juegos = $juego->buscarVideojuegos($this->busqueda, $this->pagina, $this->cantidad);
        //encripta la imagen en base 64 para que pueda ser enviada al javascript
        foreach ($juegos as &$value) {
            $value['imagen']= base64_encode($value['imagen']);
        }
        //inserta datos extra como la cantidad de resultados de la busqueda y la cantidad que se muestra por pagina
        $data[0]=$juegos;
        $data[1]=intval($total[0]['cantidad']);
        $data[2]=$this->cantidad;
        //muestra los datos como jobject
        echo json_encode($data);
    }
    

}

$obj=new ControlListaVideojuego();
$obj->listarVideojuego();

