<?php


namespace models;

require_once("Conexion.php");

class Publicacion
{



    public function commentCount($id)
    {
        $stm = Conexion::conector()->prepare("SELECT COUNT(*) as 'count' FROM comentario WHERE id_publicacion=:id");
        $stm->bindParam(":id", $id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionesJoin($palabra,$a ,$b)
    {
        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, 
                                                p.me_gusta, u.id_usuario, u.nombre as 'usuario', j.nombre 'juego', j.id_juego FROM publicacion p inner join usuario 
                                                u on u.id_usuario=p.id_usuario inner join juego j on j.id_juego=p.id_juego
                                                WHERE p.titulo LIKE '%' :palabra '%' 
                                                ORDER BY p.fecha DESC 
                                                LIMIT $a, $b");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function contarPublicacionesJoin($palabra)
    {
        $stm = Conexion::conector()->prepare("SELECT count(id_publicacion) as cantidad FROM publicacion
                                                WHERE titulo LIKE '%' :palabra '%' ");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionesWhere($palabra,$a ,$b,$id)
    {
        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha, 
                                                p.me_gusta, u.id_usuario, u.nombre as 'usuario', j.nombre 'juego', j.id_juego FROM publicacion p inner join usuario 
                                                u on u.id_usuario=p.id_usuario inner join juego j on j.id_juego=p.id_juego
                                                WHERE p.id_usuario=:id
                                                AND p.titulo LIKE '%' :palabra '%' 
                                                ORDER BY p.fecha DESC 
                                                LIMIT $a, $b");
        $stm->bindParam(":palabra",$palabra);
        $stm->bindParam(":id", $id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function contarPublicacionesWhere($palabra,$id)
    {
        $stm = Conexion::conector()->prepare("SELECT count(id_publicacion) as cantidad FROM publicacion
                                                WHERE id_usuario=:id
                                                AND titulo LIKE '%' :palabra '%' ");
        $stm->bindParam(":palabra",$palabra);
        $stm->bindParam(":id", $id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarPublicacionSeleccionada($id)
    {

        $stm = Conexion::conector()->prepare("SELECT p.id_publicacion, p.titulo, p.contenido, p.fecha,p.imagen 'imgPublic',p.me_gusta,u.id_usuario as 'id_user', u.nombre as 
                                                    'usuario', j.nombre 'juego', c.nombre 'compañia', cat.categoria 'categoria' , j.id_juego
                                                    FROM publicacion p
                                                    inner join usuario u on u.id_usuario=p.id_usuario 
                                                    inner join juego j on j.id_juego=p.id_juego 
                                                    inner join compania c on c.id_compania=j.id_compania
                                                    inner join categoria cat on cat.id_categoria=j.id_categoria
                                                    WHERE id_publicacion=:id");

        $stm->bindParam(":id", $id);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function crearPublicacion($titulo, $contenido, $fecha, $img, $mg, $id_game, $id_user)
    {

        if ($img != null) {

            $stm = Conexion::conector()->prepare("INSERT INTO publicacion VALUES(null, :titulo, :contenido, :imagen , :me_gusta, :fecha, :id_juego, :id_usuario)");
            $stm->bindParam(":titulo", $titulo);
            $stm->bindParam(":contenido", $contenido);
            $stm->bindParam(":imagen", $img);
            $stm->bindParam(":fecha", $fecha);
            $stm->bindParam(":me_gusta", $mg);
            $stm->bindParam(":id_juego", $id_game);
            $stm->bindParam(":id_usuario", $id_user);

            return $stm->execute();
        } else {
            $stm = Conexion::conector()->prepare("INSERT INTO publicacion VALUES(null, :titulo, :contenido, null, :me_gusta, :fecha, :id_juego, :id_usuario)");
            $stm->bindParam(":titulo", $titulo);
            $stm->bindParam(":contenido", $contenido);
            $stm->bindParam(":fecha", $fecha);
            $stm->bindParam(":me_gusta", $mg);
            $stm->bindParam(":id_juego", $id_game);
            $stm->bindParam(":id_usuario", $id_user);

            return $stm->execute();
        }
    }

    public function eliminarPublicacion($id)
    {


        $stm = Conexion::conector()->prepare("DELETE FROM publicacion WHERE id_publicacion=:id");
        $stm->bindParam(":id", $id);

        return $stm->execute();
    }

    public function editarPublicacion($titulo, $contenido, $img, $juego, $public)
    {


        if ($img != null) {

            $stm = Conexion::conector()->prepare("UPDATE publicacion SET titulo=:titulo ,contenido=:contenido, imagen=:imag ,id_juego=:juego WHERE id_publicacion =:id_public");
            $stm->bindParam(":titulo", $titulo);
            $stm->bindParam(":contenido", $contenido);
            $stm->bindParam(":imag",$img);
            $stm->bindParam(":juego", $juego);
            $stm->bindParam(":id_public", $public);

            return $stm->execute();
        } else {


            $stm = Conexion::conector()->prepare("UPDATE publicacion SET titulo=:titulo ,contenido=:contenido ,id_juego=:juego WHERE id_publicacion =:id_public");
            $stm->bindParam(":titulo", $titulo);
            $stm->bindParam(":contenido", $contenido);
            $stm->bindParam(":juego", $juego);
            $stm->bindParam(":id_public", $public);

            return $stm->execute();
        }
    }
}