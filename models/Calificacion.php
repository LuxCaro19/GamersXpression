<?php

namespace models;

require_once("Conexion.php");

class Calificacion{



    public function buscarCalificacion($juego,$usuario){
        $stm = Conexion::conector()->prepare("SELECT * FROM calificacion where id_usuario = :u AND id_juego = :j");
        $stm->bindParam(":u",$usuario);
        $stm->bindParam(":j",$juego);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarCalificacionJuego($juego){
        $stm = Conexion::conector()->prepare("SELECT round(AVG(calificacion),1) as calificacion FROM calificacion where id_juego = :j");
        $stm->bindParam(":j",$juego);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function calificar($juego,$usuario,$calificacion){

        $stm = Conexion::conector()->prepare("INSERT INTO calificacion VALUES (NULL, :c, :u, :j)");
        $stm->bindParam(":j", $juego);
        $stm->bindParam(":u", $usuario);
        $stm->bindParam(":c", $calificacion);
        return $stm->execute();
    }

    public function editarCalificacion($calificacion, $id){

        $stm = Conexion::conector()->prepare("UPDATE calificacion SET calificacion = :c WHERE id_calificacion = :id");
        $stm->bindParam(":c", $calificacion);
        $stm->bindParam(":id", $id);

        return $stm->execute();

    }

    
}
