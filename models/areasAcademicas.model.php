<?php 
    require_once("conexion.php");

    class AreasAcademicasModel{

        public static function mdlMostrarRegistroWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
            $sentencia->bindValue(":valor", $valor);
            $sentencia->execute();
            $registros=$sentencia->fetch();
            return $registros;

        }

        public static function mdlMostrarRegistros($tabla){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla");
            $sentencia->execute();
            $registros=$sentencia->fetchAll();
            return $registros;

        }
    }