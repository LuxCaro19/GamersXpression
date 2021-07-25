<?php

namespace models;


class Conexion{

    


    public static $user="uy9yyfwkjbrelhyf";
    public static $pass="wn8JIHK1gm97AJcQBnxb";
    public static $URL="mysql:host=beureav97j7oshc0u0ck-mysql.services.clever-cloud.com;dbname=beureav97j7oshc0u0ck";

    
    
    /*public static $user="root";
    public static $pass="";
    public static $URL="mysql:host=localhost;dbname=gamersxpression";*/



    public static function conector(){


        try{

            return new \PDO(Conexion::$URL,Conexion::$user, Conexion::$pass);

        }catch(\PDOException $ex){

            return null;
        }

    }






}