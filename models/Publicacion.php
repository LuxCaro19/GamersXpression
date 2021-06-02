<?php


namespace models;

require_once("Conexion.php");

class Publicacion{



    public function commentCount($id){
        $stm = Conexion::conector()->prepare("SELECT COUNT(*) as 'count' FROM comentario WHERE id_publicacion=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionesJoin(){
        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, p.me_gusta, u.nombre as 'usuario', j.nombre 'juego' FROM publicacion p
                                                inner join usuario u on u.id_usuario=p.id_usuario
                                                inner join juego j on j.id_juego=p.id_juego");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    


}

 