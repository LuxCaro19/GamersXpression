<?php
namespace models;

require_once("Conexion.php");

class Gusta{

    //cuenta la cantidad de likes por publicaciones
    public function Buscar($id_publicacion){

        $stm = Conexion::conector()->prepare("SELECT COUNT(me_gusta) AS total FROM me_gusta WHERE id_publicacion = :publicacion");
        $stm->bindParam(":publicacion",$id_publicacion);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Busca si existe un me gusta en una publicacion especifica realizado por un usuario
    public function BuscarEspecifico($usuario, $publicacion){

        $stm = Conexion::conector()->prepare("SELECT * FROM me_gusta WHERE id_usuario = :usuario AND id_publicacion = :publicacion");
        $stm->bindParam(":usuario",($usuario));
        $stm->bindParam(":publicacion",($publicacion));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //crea un me gusta
    public function CrearMeGusta($usuario,$publicacion){
        $stm = Conexion::conector()->prepare("INSERT INTO me_gusta VALUES (NULL,1, :usuario, :publicacion)");
        $stm->bindParam(":usuario",$usuario);  
        $stm->bindParam(":publicacion",$publicacion);
        return $stm->execute();
    }

    //elimina un me gusta
    public function EliminarMeGusta($usuario, $publicacion){
        $stm = Conexion::conector()->prepare("DELETE FROM me_gusta WHERE id_usuario = :usuario AND id_publicacion = :publicacion");
        $stm->bindParam(":usuario",$usuario);  
        $stm->bindParam(":publicacion",$publicacion);
        return $stm->execute();
    }


}

 