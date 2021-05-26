<?php

namespace models;


class Conexion{

    

    public static $user="root";
    public static $pass="";
    public static $URL="mysql:host=localhost;dbname=gamersxpression";



    public static function conector(){


        try{

            return new \PDO(Conexion::$URL,Conexion::$user, Conexion::$pass);

        }catch(\PDOException $ex){

            return null;
        }

    }






}