<?php
    Class AreasAcademicasController{
        // Cargar AreasAcademicas
        public function ctrMostrarAreasAcademicas($tabla){
            $respuesta=AreasAcademicasModel::mdlMostrarAreasAcademicas($tabla);
            return $respuesta;
        }

        public function ctrMostrarAreasAcademicasWhere($tabla,$campo,$valor){
            $respuesta=AreasAcademicasModel::mdlMostrarAreasAcademicasWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function ctrMostrarAreaAcademicaWhere($tabla,$campo,$valor){
            $respuesta=AreasAcademicasModel::mdlMostrarAreaAcademicaWhere($tabla,$campo,$valor);
            return $respuesta;
        }

        public function mdlMostrar_Ultima_AreaAcademica($tabla){
            $respuesta=AreasAcademicasModel::mdlMostrar_Ultima_AreaAcademica($tabla);
            return $respuesta;
        }

        public function ctrInsertar($tabla,$datos,$redireccion){
            // Validamos los datos
            $datos = AreasAcademicasController::ctrValidarDatos($datos,$redireccion);

            //Insertamos los datos si todo ha salido bien
            $respuesta=AreasAcademicasModel::mdlInsertar($tabla,$datos);
            return $respuesta;
            
        }

        public function ctrActualizar($tabla,$datos,$redireccion,$id){
            // Validamos los datos
            $datos = AreasAcademicasController::ctrValidarDatos($datos,$redireccion);

            $respuesta=AreasAcademicasModel::mdlActualizar($tabla,$datos,$id);
            return $respuesta;
            
        }

        public function ctrEliminar($tabla, $campo_id, $id){
            if (isset($id)) {
                $respuesta = AreasAcademicasModel::mdlEliminar($tabla, $campo_id, $id);
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
    }