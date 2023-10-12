<?php 
    require_once("conexion.php");

    class LoginModel{
        // ====================================== Comprobar Exisitencia ======================================

        // Comprobar si existe ese registro
        static public function mdlComprobar_Exisitencia_Registro($tabla,$columna,$registro){
            if (!empty($registro)) {
                $conexion = Conexion::conectar();
                $consulta = "SELECT * FROM $tabla  WHERE $columna LIKE '$registro' ";
                $resultados = $conexion->query($consulta);
                $filas = $resultados->rowCount();
                if ($filas>0) {
                    $resultado = $resultados->fetch();
                }else {
                    $resultado=NULL;
                }
                return $resultado;
            }
        }

        // Filtrar varchar
        static public function mdlfiltrarVarchar($texto){
            if (!empty($texto)) {
                $textoValidado = trim($texto);
                $textoValidado = filter_var(stripslashes($textoValidado), FILTER_SANITIZE_STRING);
                return $textoValidado;
            }else {
                // No es texto
                return NULL;
            }
        }

        // Filtrar Correo
        static public function mdlfiltrarCorreo($correo){
            if (!empty($correo)) {
                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    // No es un correo
                    return NULL;
                }else{
                    $correoValidado = trim($correo);
                    $correoValidado = filter_var(stripslashes($correoValidado), FILTER_SANITIZE_EMAIL);
                    return $correoValidado;
                }
            }else {
                // vacio
                return NULL;
            }
        }

        // Registrar Usuario
        static public function mdlRegistrarUsuario($tabla, $datos){
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

        // Mostrar ultimo usuario
        static public function mdlMostrar_Ultimo_Registro($tabla,$id){
            $conexion = Conexion::conectar();
            $consulta="SELECT * FROM $tabla Order by $id desc LIMIT 1";
            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }

    }