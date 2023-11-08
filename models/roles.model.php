<?php 
    require_once("conexion.php");

    class RolesModel{

        public static function mdlInsertar($tabla,$datos){
            
            $conexion = Conexion::conectar();
            //Extraemos los campos
            $campos = implode(",",array_keys($datos));
            $valores = ":".implode(",:",array_keys($datos));

            //Hacemos la consulta
            $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";

            //La preparamos
            $sentencia=$conexion->prepare($sql);
            foreach ($datos as $campo => $valor) {
                $sentencia->bindValue(":$campo", $valor);
            }

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }
            $sentencia=null;

        }

        public static function mdlMostrarRegistroWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
            $sentencia->bindValue(":valor", $valor);
            $sentencia->execute();
            $registros=$sentencia->fetch();
            return $registros;

        }

        public static function mdlMostrarRegistrosWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo = :valor");
            $sentencia->bindValue(":valor", $valor);
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;

        }

        public static function mdlMostrarRegistrosWhereIn($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE $campo IN ($valor)");
            // var_dump($sentencia);
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;

        }

        public static function mdlComprobarRolUsuario($tabla,$usuario,$rol){
            
            $conexion = Conexion::conectar();
            $sentencia = $conexion->prepare("SELECT * FROM $tabla WHERE usuario LIKE :usuario AND rol LIKE :rol");
            $sentencia->bindValue(":usuario", $usuario);
            $sentencia->bindValue(":rol", $rol);
            $sentencia->execute();
            $registros=$sentencia->fetch();
            var_dump($registros);
            return $registros;

        }
    }