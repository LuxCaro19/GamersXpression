<?php


namespace models;

require_once("Conexion.php");

class Videojuego{


    public function crearJuego($nombre, $resumen, $imagen, $compania, $categoria)
    {
        $stm = Conexion::conector()->prepare("INSERT INTO juego VALUES(NULL, :nombre, :resumen, NULL, :imagen, :compania, null, :categoria)");
        $stm->bindParam(":nombre", $nombre);
        $stm->bindParam(":resumen", $resumen);
        $stm->bindParam(":imagen", $imagen);
        $stm->bindParam(":compania", $compania);
        $stm->bindParam(":categoria", $categoria);
        return $stm->execute();
    }
    public function crearJuegoConSecuela($nombre, $resumen, $imagen, $compania, $categoria,$secuela)
    {
        $stm = Conexion::conector()->prepare("INSERT INTO juego VALUES(NULL, :nombre, :resumen, NULL, :imagen, :compania, :secuela, :categoria)");
        $stm->bindParam(":nombre", $nombre);
        $stm->bindParam(":resumen", $resumen);
        $stm->bindParam(":imagen", $imagen);
        $stm->bindParam(":compania", $compania);
        $stm->bindParam(":secuela", $secuela);
        $stm->bindParam(":categoria", $categoria);
        return $stm->execute();
    }

    public function cargarAllVideojuegos(){
        $stm = Conexion::conector()->prepare("SELECT * FROM juego");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //carga datos especificos de un videojuego utilizando un id, 
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

    //estas funcones son para contar la cantidad de resultados que se obtienen de una busqueda, este numero es necesario por que la funcion superior solo devuelve una porcion de los datos.
    public function contarBusquedaVideojuegos($palabra){
        $stm = Conexion::conector()->prepare("SELECT COUNT(id_juego) as cantidad FROM juego WHERE nombre LIKE '%' :palabra '%'");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    //estas funcones son para contar la cantidad de resultados que se obtienen de una busqueda, este numero es necesario por que la funcion superior solo devuelve una porcion de los datos.
    public function cargarCreadores(){
        $stm = Conexion::conector()->prepare("SELECT * from compania");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //carga las categorias
    public function cargarCategoria(){
        $stm = Conexion::conector()->prepare("SELECT * from categoria");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //carga solo los nombres y el id para hacer la consulta mas corta
    public function cargarListaJuegos(){
        $stm = Conexion::conector()->prepare("SELECT id_juego,nombre FROM juego");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
   
}

 