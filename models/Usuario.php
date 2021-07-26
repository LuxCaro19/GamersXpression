<?php
namespace models;

require_once("Conexion.php");

class Usuario{


    //inicia session con un usuario que este habilitado, osea con estado 1
    public function login($correo, $clave){

        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE correo=:correo AND contraseña=:clave AND estado='HABILITADO'");
        $stm->bindParam(":correo",$correo);
        $stm->bindParam(":clave",($clave));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }
    //crea un usuario registro
    public function CrearUsuairo($data){
        $stm = Conexion::conector()->prepare("INSERT INTO usuario VALUES(NULL,:nombre,:correo,:contra,'HABILITADO', 3)");
        $stm->bindParam(":nombre",$data['nombre']);
        $stm->bindParam(":correo",$data['correo']);
        $stm->bindParam(":contra",$data['contra']);
        return $stm->execute();
    }

    //busca un usuario por id
    public function BuscarUsuario($id){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE id_usuario=:id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //busca un usuario por correo
    public function BuscarUsuarioCorreo($correo){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE correo=:correo");
        $stm->bindParam(":correo",$correo);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //busca un usuario por nombre
    public function BuscarUsuarioNombre($nombre){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE nombre=:nombre");
        $stm->bindParam(":nombre",$nombre);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //busca una porcion de los resultados de los usuarios, de esta manera no se saturan los datos al cargar grandes volumenes de datos
    public function buscarUsuarios($palabra,$a ,$b,){
        $stm = Conexion::conector()->prepare("SELECT u.id_usuario, u.nombre, u.correo, u.estado, u.id_tipo_usuario, t.tipo FROM usuario u
                                                LEFT JOIN tipo_usuario t ON u.id_tipo_usuario = t.id_tipo_usuario
                                                WHERE u.nombre LIKE '%' :palabra '%' 
                                                AND u.id_tipo_usuario<>'2'
                                                LIMIT $a, $b ");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    //estas funcones son para contar la cantidad de resultados que se obtienen de una busqueda, este numero es necesario por que la funcion superior solo devuelve una porcion de los datos.
    public function contarBusquedaUsuarios($palabra){
        $stm = Conexion::conector()->prepare("SELECT COUNT(id_usuario) as cantidad FROM usuario WHERE nombre LIKE '%' :palabra '%' AND id_tipo_usuario<>'2' ");
        $stm->bindParam(":palabra",$palabra);
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id, $estado)
    {
        $stm = Conexion::conector()->prepare("UPDATE usuario SET estado=:estado WHERE id_usuario =:id");
        $stm->bindParam(":id", $id);
        $stm->bindParam(":estado", $estado);
        return $stm->execute();
    }
    public function cambiarTipo($id, $tipo)
    {
        $stm = Conexion::conector()->prepare("UPDATE usuario SET id_tipo_usuario=:tipo WHERE id_usuario =:id");
        $stm->bindParam(":id", $id);
        $stm->bindParam(":tipo", $tipo);
        return $stm->execute();
    }

    public function eliminar($id)
    {
        $stm = Conexion::conector()->prepare("DELETE FROM usuario WHERE id_usuario =:id");
        $stm->bindParam(":id", $id);
        return $stm->execute();
    }

}

 