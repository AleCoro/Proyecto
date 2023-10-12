<?php
class ClasesController{
    
    public function ctrInsertar($tabla, $datos){

        // Validamos los datos
        $datos = ClasesController::ctrValidarDatos($datos);

        //Insertamos los datos si todo ha salido bien
        ClasesModel::mdlInsertar($tabla, $datos);

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
            
        $respuesta=ClasesModel::mdlMostrarRegistroWhere($tabla,$campo,$valor);

        return $respuesta;
    }

    public function ctrMostrarRegistros($tabla){
            
        $respuesta=ClasesModel::mdlMostrarRegistros($tabla);

        return $respuesta;
    }
}
