<?php
    Class AsignaturasController{
        // Cargar Asignaturas
        public function ctrMostrarAsignaturas($tabla){
            $respuesta=AsignaturasModel::mdlMostrarAsignaturas($tabla);
            return $respuesta;
        }

        public function ctrMostrarAsignaturasWhere($tabla,$campo,$valor){
            $respuesta=AsignaturasModel::mdlMostrarAsignaturasWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function ctrMostrarAsignaturaWhere($tabla,$campo,$valor){
            $respuesta=AsignaturasModel::mdlMostrarAsignaturaWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function ctrMostrar_Ultima_Asignatura($tabla){
            $respuesta=AsignaturasModel::mdlMostrar_Ultima_Asignatura($tabla);
            return $respuesta;
        }

        public function ctrInsertar($tabla,$datos,$redireccion){
            // Validamos los datos
            $datos = AsignaturasController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta = AsignaturasModel::mdlInsertar($tabla,$datos);
            return $respuesta;
            
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id){
            // Validamos los datos
            $datos = AsignaturasController::ctrValidarDatos($datos,$redireccion);

            $respuesta=AsignaturasModel::mdlActualizar($tabla,$datos,$id);
            return $respuesta;
            
        }

        public function ctrEliminar($tabla, $campo_id, $id){
            if (isset($id)) {
                $respuesta = AsignaturasModel::mdlEliminar($tabla, $campo_id, $id);
                return $respuesta;
            }
        }

        public function ctrValidarDatos($datos){
            // Validamos si en el array asociativo llega un fichero
            foreach ($datos as $campo => $valor) {
                // Validamos tipo texto
                if (is_string($valor)) {
                    $textoValidado = trim($valor);
                    $textoValidado = filter_var(stripslashes($textoValidado), FILTER_SANITIZE_STRING);
                    $datos[$campo] = $textoValidado;
                }
            }
            return $datos;
        }

        public function ctrReservasPorAsignaturas(){
                        
            $respuesta=AsignaturasModel::mdlReservasPorAsignaturas();
            return $respuesta;
        }

        public function ctrReservasPorFecha(){
            $respuesta=AsignaturasModel::mdlReservasPorFecha();
            return $respuesta;
        }
    }