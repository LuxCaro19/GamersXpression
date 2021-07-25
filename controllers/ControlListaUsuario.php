<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");



class ControlListaUsuario
{
    public $busqueda;
    public $pagina;
    public $cantidad;

    public function __construct()
    {
        if (isset($_POST['busqueda'])) { $this->busqueda = $_POST['busqueda'];} else {$this->busqueda ="";}
        if (isset($_POST['pagina'])) { $this->pagina = $_POST['pagina'];} else {$this->pagina =0;}
        $this->cantidad = 10;
    }

    public function listarUsuarios(){

        $usuario = new Usuario();

        //cuenta la cantidad de usuarios que arrojara la busqueda
        $total = $usuario->contarBusquedaUsuarios($this->busqueda);   
        //calcula las paginas necesarias para mostrar todos los usuarios
        $this->pagina = $this->pagina * $this->cantidad;
        //realiza la busqueda y fuarda los usuarios en una variable
        $juegos = $usuario->buscarUsuarios($this->busqueda, $this->pagina, $this->cantidad);
        //juarda los usuarios, la cantidad de resultados y la cantidad de usuarios por paginas  en una variable
        $data[0]=$juegos;
        $data[1]=intval($total[0]['cantidad']);
        $data[2]=$this->cantidad;
        echo json_encode($data);
    }
    

}

$obj=new ControlListaUsuario();
$obj->listarUsuarios();

