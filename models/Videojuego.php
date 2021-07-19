<?php


namespace models;

require_once("Conexion.php");

class Videojuego{



    public function cargarAllVideojuegos(){
        $stm = Conexion::conector()->prepare("SELECT * FROM juego");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cargarDetalleVideojuego($id_juego){
        $stm = Conexion::conector()->prepare("SELECT j.nombre, j.id_juego, j.historia_resumida, j.imagen, j.id_juego_secuela, c.nombre as 'cnombre', ca.categoria  FROM juego j
        INNER JOIN compania c ON j.id_compania = c.id_compania
        INNER JOIN categoria ca ON ca.id_categoria = j.id_categoria
         WHERE j.id_juego = :id_juego
        ");
        $stm->bindParam(":id_juego",$id_juego);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //busca un videojuego que contenga la informacion de "palabra", la variable "a" indica desde donde comenzar a mostrar, y la variable "b" indica cuantos objetos mostrar
    
    public function buscarVideojuegos($palabra,$a ,$b){
        $stm = Conexion::conector()->prepare("SELECT * FROM juego WHERE nombre LIKE '%' :palabra '%' LIMIT $a, $b");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //estas funcones son para contar la busqueda de las consultas realizadas en la parte superior, son necesarias para poder paginar ya que la consulta anterior solo devuelve
    //una seccion  y esta consulta devuelve la cantidad de la busqueda total
    public function contarBusquedaVideojuegos($palabra){
        $stm = Conexion::conector()->prepare("SELECT COUNT(id_juego) as cantidad FROM juego WHERE nombre LIKE '%' :palabra '%'");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
   
}

 