<?php

namespace models;

require_once("Conexion.php");

class Comentarios{



    public function cargarComentarios($id){
        $stm = Conexion::conector()->prepare("SELECT c.id_comentario 'id_comment', c.comentario, c.fecha,c.id_publicacion 'id_publi',u.id_usuario 'id_user', u.nombre 'usuario' FROM comentario c
                                            inner JOIN usuario u on u.id_usuario=c.id_usuario
                                            where id_publicacion=:id
                                            ORDER BY c.fecha DESC
                                            ");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function cargarComentarioEspecifico($idComentario){
        $stm = Conexion::conector()->prepare("SELECT c.id_comentario 'id_comment', c.comentario, c.fecha,c.id_publicacion 'id_publi',u.id_usuario 'id_user', u.nombre 'usuario' FROM comentario c
                                            inner JOIN usuario u on u.id_usuario=c.id_usuario
                                            where id_comentario=:id
                                            ORDER BY c.fecha DESC
                                            ");
        $stm->bindParam(":id",$idComentario);
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

    public function eliminarComentario($id){

        $stm = Conexion::conector()->prepare("DELETE FROM comentario WHERE id_comentario=:id");
        $stm->bindParam(":id", $id);
        return $stm->execute();

    }

}