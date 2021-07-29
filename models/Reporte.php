<?php
namespace models;

require_once("Conexion.php");

class Reporte{


    //crea un reporte de publicacion
    public function CrearReportePublicacion($data){
        $stm = Conexion::conector()->prepare("INSERT INTO report_publicacion VALUES (NULL, :razon, :descripcion , :fecha, :id_con, :id_usr)");
        $stm->bindParam(":razon",$data['razon']);
        $stm->bindParam(":descripcion",$data['descripcion']);
        $stm->bindParam(":fecha",$data['fecha']);
        $stm->bindParam(":id_con",$data['id_con']);
        $stm->bindParam(":id_usr",$data['id_usr']);
        return $stm->execute();
    }
    //crea un reporte de comentario
    public function CrearReporteComentario($data){
        $stm = Conexion::conector()->prepare("INSERT INTO report_comentario VALUES (NULL, :razon, :descripcion , :fecha, :id_con, :id_usr)");
        $stm->bindParam(":razon",$data['razon']);
        $stm->bindParam(":descripcion",$data['descripcion']);
        $stm->bindParam(":fecha",$data['fecha']);
        $stm->bindParam(":id_con",$data['id_con']);
        $stm->bindParam(":id_usr",$data['id_usr']);
        return $stm->execute();
    }

    //busca una porcion de los resultados de los reportes, de esta manera no se saturan los datos al cargar grandes volumenes de datos
    public function buscarReportesComentarios($a ,$b){
        $stm = Conexion::conector()->prepare("SELECT rep.id_report_comentario, rep.id_comentario, rep.id_razones_report , rep.descripcion, rep.fecha, rep.id_comentario, rep.id_usuario, raz.razon, usr.nombre FROM report_comentario rep
                                                LEFT JOIN razon_report raz ON rep.id_razones_report = raz.id_razon_report
                                                LEFT JOIN usuario usr ON rep.id_usuario = usr.id_usuario
                                                LIMIT $a, $b ");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //busca una porcion de los resultados de los reportes, de esta manera no se saturan los datos al cargar grandes volumenes de datos
    public function buscarReportesPublicacion($a ,$b){
        $stm = Conexion::conector()->prepare("SELECT rep.id_report_publicacion, rep.id_razon_report , rep.descripcion, rep.fecha, rep.id_publicacion, rep.id_usuario, raz.razon, usr.nombre FROM report_publicacion rep
                                                LEFT JOIN razon_report raz ON rep.id_razon_report = raz.id_razon_report
                                                LEFT JOIN usuario usr ON rep.id_usuario = usr.id_usuario
                                                LIMIT $a, $b ");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //estas funcones son para contar la cantidad de resultados que se obtienen de una busqueda, este numero es necesario por que la funcion superior solo devuelve una porcion de los datos.
    public function contarBusquedaRepComentarios(){
        $stm = Conexion::conector()->prepare("SELECT COUNT(id_comentario) as cantidad FROM report_comentario");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    //estas funcones son para contar la cantidad de resultados que se obtienen de una busqueda, este numero es necesario por que la funcion superior solo devuelve una porcion de los datos.
    public function contarBusquedaRepPublicciones(){
        $stm = Conexion::conector()->prepare("SELECT COUNT(id_report_publicacion) as cantidad FROM report_publicacion");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function eliminarReporteComentario($id)
    {
        $stm = Conexion::conector()->prepare("DELETE FROM report_comentario WHERE id_report_comentario =:id");
        $stm->bindParam(":id", $id);
        return $stm->execute();
    }

    public function eliminarReportePublicacion($id)
    {
        $stm = Conexion::conector()->prepare("DELETE FROM report_publicacion WHERE id_report_publicacion =:id");
        $stm->bindParam(":id", $id);
        return $stm->execute();
    }

    //esta funcion se encarga de consultar las razones disponibles para reportar
    public function buscarRazones(){
        $stm = Conexion::conector()->prepare("SELECT * FROM razon_report");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

}

 