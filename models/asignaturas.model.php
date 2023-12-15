<?php 
    require_once("conexion.php");

    class AsignaturasModel{

        public static function mdlMostrarAsignaturas($tabla){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla");
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        }

        public static function mdlMostrarAsignaturasWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
            $sentencia->execute();
            $registros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        }

        public static function mdlMostrarAsignaturaWhere($tabla,$campo,$valor){
            
            $conexion = Conexion::conectar();
            $sentencia=$conexion->prepare("SELECT * FROM $tabla WHERE $campo LIKE '$valor'");
            $sentencia->execute();
            $registros=$sentencia->fetch();
            return $registros;
        }

        public static function mdlMostrar_Ultima_Asignatura($tabla){
            $conexion = Conexion::conectar();
            $id="id";
            $consulta="SELECT * FROM $tabla Order by $id desc LIMIT 1";
            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }

        public static function mdlMostrar_Asignaturas_Ordenadas($tabla,$campo,$orden){
            $conexion = Conexion::conectar();
            $consulta="SELECT * FROM $tabla Order by $campo $orden LIMIT 1";
            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }

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

        public static function mdlActualizar($tabla,$datos,$campo_id,$id){
            
            $conexion = Conexion::conectar();
            //Extraemos los campos
            $valores="";
            foreach ($datos as $campo => $valor) {
                $valores .= "$campo = :$campo,";
            }
            $valores = rtrim($valores, ",");

            //Hacemos la consulta
            $sql = "UPDATE $tabla SET $valores WHERE $campo_id = :id";

            //La preparamos
            $sentencia=$conexion->prepare($sql);
            foreach ($datos as $campo => $valor) {
                $sentencia->bindValue(":$campo", $valor);
            }
            $sentencia->bindValue(":id",$id);

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }
            $sentencia=null;
        }

        public static function mdlEliminar($tabla, $campo_id, $id){
            
            $conexion = Conexion::conectar();

            //Hacemos la consulta
            $sql = "DELETE FROM $tabla WHERE $campo_id = :id";
            // var_dump($sql);

            //La preparamos
            $sentencia=$conexion->prepare($sql);
            $sentencia->bindValue(":id",$id);

            //Y la ejecutamos
            if ($sentencia->execute()) {
                return true;
            }else {
                return false;
            }
            $sentencia=null;
        }

        public static function mdlAsignaturasPopulares(){
            $conexion = Conexion::conectar();

            $consulta = "SELECT asi.*, res.*, COUNT(DISTINCT(res.id_reserva)) as Reservas, 
                ROUND(AVG(res.pagado), 2) as PrecioMedio, 
                COUNT(DISTINCT(CASE WHEN imp.disponibilidad = 0 AND imp.fecha_imparte > NOW() THEN imp.profesor END)) as ProfesoresImpartiendo
                FROM asignaturas as asi JOIN reservas as res ON asi.id_asignatura = res.asignatura 
                JOIN imparte as imp ON asi.id_asignatura = imp.asignatura
                GROUP BY id_asignatura
                ORDER BY Reservas DESC
                LIMIT 3; ";

            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetchAll();
                return $resultado;
            }
        }

        public static function mdlGetAsignaturasImpartidas($id_profesor){
            $conexion = Conexion::conectar();

            $consulta = "SELECT id_reserva, alumno, profesor, GROUP_CONCAT(nombre_asignatura) as 'todasAsignaturas', GROUP_CONCAT(titulo_tema) as 'todosTemas'
            FROM reservas as r
            INNER JOIN asignaturas as a ON r.asignatura = a.id_asignatura
            INNER JOIN contenido_clase as c ON r.id_reserva = c.reserva
            INNER JOIN temas as t ON c.tema = t.id_tema
            WHERE profesor LIKE $id_profesor;";

            $resultados=$conexion->query($consulta);
            if ($resultados) {
                $resultado = $resultados->fetch();
                return $resultado;
            }
        }
    }