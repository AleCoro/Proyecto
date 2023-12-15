<?php
class ReservasController
{
    // Cargar Reservas
    public function ctrMostrarReservas($tabla){
        $respuesta = ReservasModel::mdlMostrarReservas($tabla);
        return $respuesta;
    }

    public function ctrMostrarReservasWhere($tabla, $campo, $valor){
        $respuesta = ReservasModel::mdlMostrarReservasWhere($tabla, $campo, $valor);
        return $respuesta;
    }

    public function ctrMostrarReservaWhere($tabla, $campo, $valor){
        $respuesta = ReservasModel::mdlMostrarReservaWhere($tabla, $campo, $valor);
        return $respuesta;
    }

    public function mdlMostrar_Ultima_Reserva($tabla){
        $respuesta = ReservasModel::mdlMostrar_Ultima_Reserva($tabla);
        return $respuesta;
    }

    public function ctrInsertar($tabla, $datos){
        // Validamos los datos
        $datos = ReservasController::ctrValidarDatos($datos);

        //Insertamos los datos si todo ha salido bien
        $respuesta = ReservasModel::mdlInsertar($tabla, $datos);
        return $respuesta;
    }

    public function ctrActualizar($tabla, $datos, $id){
        // Validamos los datos
        $datos = ReservasController::ctrValidarDatos($datos);

        $respuesta = ReservasModel::mdlActualizar($tabla, $datos, $id);
        return $respuesta;
    }

    public function ctrEliminar($tabla, $campo_id, $id){
        if (isset($id)) {
            $respuesta = ReservasModel::mdlEliminar($tabla, $campo_id, $id);
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

    // Cargar Paginacion
    public function ctrMostrarPaginacion($tabla, $pagina, $registrosxpagina){
        $orden = "ASC";

        if ($pagina == 1) {
            $inicio = 0;
        } else {
            $inicio = ($pagina * $registrosxpagina) - $registrosxpagina;
        }

        $respuesta = ReservasModel::mdlMostrarPaginacion($tabla, $inicio, $registrosxpagina, $orden);
        return $respuesta;
    }

    //Ultimas 6 reservas expiradas
    public function ctrMostrarReservasExpiradas($campo, $valor){
        $respuesta = ReservasModel::mdlMostrarReservasExpiradas($campo, $valor);
        return $respuesta;
    }

    //Ultimas 6 reservas sin expirar
    public function ctrMostrarReservasSinExpirar($campo, $valor){
        $respuesta = ReservasModel::mdlMostrarReservasSinExpirar($campo, $valor);
        return $respuesta;
    }

    public function formatearFecha($fechaOriginal){
        $datetime = new DateTime($fechaOriginal);
        return $datetime->format('d/m/Y H:i');
    }

    public function ctrValoracionesProfesor($id_profesor){
         $respuesta = ReservasModel::mdlValoracionesProfesor($id_profesor);
         return $respuesta;
    }
}
