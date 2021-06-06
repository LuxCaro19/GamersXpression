<?php


namespace models;

require_once("Conexion.php");

class Videojuego{



    public function cargarAllVideojuegos(){
        $stm = Conexion::conector()->prepare("SELECT * FROM juego");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    

    


}

 