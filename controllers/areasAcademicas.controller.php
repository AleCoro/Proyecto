<?php
class AreasAcademicasController{

    public function ctrMostrarRegistroWhere($tabla,$campo,$valor){
            
        $respuesta = AreasAcademicasModel::mdlMostrarRegistroWhere($tabla,$campo,$valor);

        return $respuesta;
    }

    public function ctrMostrarRegistros($tabla){
            
        $respuesta = AreasAcademicasModel::mdlMostrarRegistros($tabla);

        return $respuesta;
    }
}