<?php
namespace models;

require_once("Conexion.php");

class Usuario{


    //inicia session con un usuario que este habilitado, osea con estado 1
    public function login($correo, $clave){

        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE correo=:correo AND contraseña=:clave AND estado='HABILITADO'");
        $stm->bindParam(":correo",$correo);
        $stm->bindParam(":clave",($clave));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //crea un usuario registro
    public function CrearUsuairo($data){
        $stm = Conexion::conector()->prepare("INSERT INTO usuario VALUES(NULL,:nombre,:correo,:contra,'HABILITADO', 3)");
        $stm->bindParam(":nombre",$data['nombre']);
        $stm->bindParam(":correo",$data['correo']);
        $stm->bindParam(":contra",$data['contra']);
        return $stm->execute();
    }

    //busca un usuario por rut
    public function BuscarUsuario($id){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE id_usuario=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }



}

 