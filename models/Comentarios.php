<?php

namespace models;

require_once("Conexion.php");

class Comentarios{



    public function cargarComentarios($id){
        $stm = Conexion::conector()->prepare("SELECT c.comentario, c.fecha, u.nombre 'usuario' FROM comentario c
                                            inner JOIN usuario u on u.id_usuario=c.id_usuario
                                            where id_publicacion=:id
                                            ORDER BY c.fecha DESC
                                            ");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function crearComentario($coment, $fecha, $id_p, $id_u){

        $stm = Conexion::conector()->prepare("INSERT INTO comentario VALUES(null, :coment, :fecha, :id_p, :id_u)");
        $stm->bindParam(":coment", $coment);
        $stm->bindParam(":fecha", $fecha);
        $stm->bindParam(":id_p", $id_p);
        $stm->bindParam(":id_u", $id_u);
        return $stm->execute();

    }

}