<?php

namespace controllers;

use models\Usuario as Usuario;

require_once("../models/Usuario.php");


class ControlAccionUsuario
{
    public $accion;
    public $usuario;    

    public function __construct()
    {

        $this->accion = $_POST['accion'];
        $this->usuario = $_POST['id_usuario'];

    }

    public function ejecutarAccion(){

        $usuario = new Usuario();
        //sependiendo de la accion que se envie, funcionara de difernete manera, 1 para cambiar estado, 2 para cambiar tipo y 3 para eliminar
        
        switch ($this->accion) {
            case 1:
                //busca el estado del usuario y crea una variable con el opuesto
                $estadoactual = $usuario->BuscarUsuario($this->usuario)[0]['estado'];
                if ($estadoactual == 'HABILITADO') {
                    $nuevoestado = 'DESHABILITADO';
                } else {
                    $nuevoestado = 'HABILITADO';
                }
                //ejectua la funcion para cambiar el estado usando el nuevo tipo y guarda el resultado en una variable
                $accion = $usuario->cambiarEstado($this->usuario,$nuevoestado);
                //devuelve el mensaje dependiendo si se realizao o no la accion
                if ($accion) {
                    $mensaje = ["msg"=>"se cambiado el estado del usuario"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"no se ha podido cambiar el estado"];
                    echo json_encode($mensaje); 
                }
                break;

            case 2:
                //busca el tipo actual del usuario
                $tipoactual = $usuario->BuscarUsuario($this->usuario)[0]['id_tipo_usuario'];
                
                //guarda en una variable el tipo contrario, si es moderador1 entonces cambia a usuuario3 y viceversa 
                if ($tipoactual == 3) {
                    $nuevotipo = 1;
                } else {
                    $nuevotipo = 3;
                }
                //ejecuta la funcion para cambiar el usuario
                $accion = $usuario->cambiarTipo($this->usuario,$nuevotipo);
                //devuelve el mensaje dependiendo si se realizao o no la accion
                if ($accion) {
                    $mensaje = ["msg"=>"se ha cambiado el tipo de usuario"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>"no se hapodido cambiar el tipo de usuario"];
                    echo json_encode($mensaje); 
                }
                break;
            case 3:
                //ejecuta la funcion de eliminar un usuario
                $accion = $usuario->eliminar($this->usuario);
                //devuelve un mensale dependiendo si se elimino o no
                if ($accion) {
                    $mensaje = ["msg"=>"usuario ha sido eliminado"];
                    echo json_encode($mensaje); 
                } else {
                    $mensaje = ["msg"=>" no se ha podido eliminar al usuario"];
                    echo json_encode($mensaje); 
                }
                break;
            default:
                //este mensaje es en caso de que la accion no se haya establecido
                $mensaje = ["msg"=>"esto no deberia ser poder ser leido por nadie"];
                echo json_encode($mensaje); 
        }

    }

}

$obj=new ControlAccionUsuario();
$obj->ejecutarAccion();
