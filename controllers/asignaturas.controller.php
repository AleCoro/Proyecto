<?php
class AsignaturasController{
    
    public function ctrInsertar($tabla, $datos){

        // Validamos los datos
        $datos = AsignaturasController::ctrValidarDatos($datos);

        //Insertamos los datos si todo ha salido bien
        AsignaturasModel::mdlInsertar($tabla, $datos);

    }

    public function ctrValidarDatos($datos){
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
            
        $respuesta=AsignaturasModel::mdlMostrarRegistroWhere($tabla,$campo,$valor);

        return $respuesta;
    }

    public function ctrMostrarRegistros($tabla){
            
        $respuesta=AsignaturasModel::mdlMostrarRegistros($tabla);

        return $respuesta;
    }
}
