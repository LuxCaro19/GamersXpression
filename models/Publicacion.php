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
        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, 
                                                p.me_gusta, u.nombre as 'usuario', j.nombre 'juego' FROM publicacion p inner join usuario 
                                                u on u.id_usuario=p.id_usuario inner join juego j on j.id_juego=p.id_juego 
                                                ORDER BY p.fecha DESC ");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionesWhere($id){
        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, p.me_gusta, u.nombre as 'usuario', j.nombre 'juego' FROM publicacion p
                                                inner join usuario u on u.id_usuario=p.id_usuario
                                                inner join juego j on j.id_juego=p.id_juego
                                                WHERE p.id_usuario=:id
                                                ORDER BY p.fecha DESC ");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionSeleccionada($id){

        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, p.me_gusta, u.nombre as 
                                                    'usuario', j.nombre 'juego', c.nombre 'compañia', cat.categoria 'categoria'
                                                    FROM publicacion p
                                                    inner join usuario u on u.id_usuario=p.id_usuario 
                                                    inner join juego j on j.id_juego=p.id_juego 
                                                    inner join compania c on c.id_compania=j.id_compania
                                                    inner join categoria cat on cat.id_categoria=j.id_categoria
                                                    WHERE id_publicacion=$id");
        
        $stm->bindParam(":id",$id);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);


    }

    public function crearPublicacion($titulo, $contenido, $fecha, $mg, $id_game, $id_user)
    {
        $stm = Conexion::conector()->prepare("INSERT INTO publicacion VALUES(null, :titulo, :contenido, null, :me_gusta, :fecha, :id_juego, :id_usuario)");
        $stm->bindParam(":titulo", $titulo);
        $stm->bindParam(":contenido", $contenido);
        //$stm->bindParam(":imagen", $data['img']);
        $stm->bindParam(":fecha", $fecha);
        $stm->bindParam(":me_gusta", $mg);
        $stm->bindParam(":id_juego", $id_game);
        $stm->bindParam(":id_usuario", $id_user);

        return $stm->execute();



    }



    


}

 