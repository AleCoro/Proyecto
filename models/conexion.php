<?php
    class Conexion{
        public static function conectar(){
            $bd = "academia";
            $conexion = new PDO("mysql:host=localhost;dbname=$bd","root","");
            $conexion->exec("set names utf8");
            
            return $conexion;
        }
    }