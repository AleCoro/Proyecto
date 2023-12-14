<?php
class RolesController{
    
    public function ctrInsertar($tabla, $datos){
        // Validamos los datos
        $datos = RolesController::ctrValidarDatos($datos);

        //Insertamos los datos si todo ha salido bien
        $respuesta = RolesModel::mdlInsertar($tabla, $datos);
        return $respuesta;
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

    public function ctrMostrarRegistroWhere($tabla,$campo,$valor){
        $respuesta=RolesModel::mdlMostrarRegistroWhere($tabla,$campo,$valor);
        return $respuesta;
    }

    public function ctrMostrarRegistrosWhere($tabla,$campo,$valor){
        $respuesta=RolesModel::mdlMostrarRegistrosWhere($tabla,$campo,$valor);
        return $respuesta;
    }

    public function ctrMostrarRegistrosWhereIn($tabla,$campo,$valor){
        $respuesta=RolesModel::mdlMostrarRegistrosWhereIn($tabla,$campo,$valor);
        return $respuesta;
    }

    public function ctrEliminar($tabla, $campo_id, $id){
        if (isset($id)) {
            $respuesta = AsignaturasModel::mdlEliminar($tabla, $campo_id, $id);
            return $respuesta;
        }
    }
}
