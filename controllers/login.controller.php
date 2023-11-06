<?php
class LoginController
{
    // ====================================== INGRESO DE USUARIO ======================================

    public function ctrLogin()
    {

        if (isset($_POST['usuario'])) {
            $usuario = LoginController::ctrfiltrarVarchar($_POST['usuario']);
            $tabla = "usuarios";
            $comprobar = LoginController::ctrComprobar_Exisitencia_Registro($tabla, 'usuario', $usuario);

            $contraseña = $_POST["password"];
            // $contraseña = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            if ($comprobar !== NULL) {
                $id_usuario = $comprobar["id_usuario"];
                if (isset($contraseña) && !empty($contraseña)) {
                    if ($contraseña == $comprobar["password"]) {
                        $_SESSION["id_usuario"] = $id_usuario;
                        $_SESSION["session_usuario"] = $usuario;
                        $respuesta =  '<script>window.location="inicio"</script>';
                    } else {
                        $respuesta =  '<br><div class="alert alert-danger">Error al introducir la contraseña</div>';
                    }
                } else {
                    $respuesta =  '<br><div class="alert alert-danger">Rellena la contraseña</div>';
                }
            } else {
                $respuesta =  '<br><div class="alert alert-danger">El usuario no existe</div>';
            }

            return $respuesta;
        }
    }

    // ====================================== REGISTRO DE USUARIO ======================================
    public function ctrRegister()
    {
        if (isset($_POST["nuevoUsuario"])) {
            $tabla = "usuarios";
            $columna = "usuario";
            $registro = $_POST["Usuario"];

            // Comprobamos si ya existe ese usuario
            $existe = LoginController::ctrComprobar_Exisitencia_Registro($tabla, $columna, $registro);

            // Si no existe validamos los campos y guardamos en la base de datos la informacion
            if ($existe == null) {
                if (
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["Usuario"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])
                ) {

                    $tabla = "usuarios";
                    $datos_usuario = array(
                        "nombre" => $_POST["nombre"],
                        "apellidos" => $_POST["apellidos"],
                        "usuario" => $_POST["Usuario"],
                        "password" => $_POST["password"],
                        "direccion" => $_POST["direccion"],
                        "telefono" => $_POST["telefono"],
                        "email" => $_POST["Email"],
                        "fecha_nacimiento" => $_POST["fecha"]
                    );

                    // Controlamos que los campos necesarios para el profesor esten rellenos
                    if ($_POST["rol"] == "Profesor") {
                        if (isset($_POST["asignaturas"]) && $_POST["asignaturas"] == "") {
                            $respuesta =  '<br><div class="alert alert-danger">¡Debes seleccionar una asignatura!</div>';
                            return $respuesta;
                        }
                        if ($_POST["precio"] <= 0) {
                            $respuesta =  '<br><div class="alert alert-danger">¡Debes poner el precio de tu hora!</div>';
                            return $respuesta;
                        }
                    }


                    // Insertamos los datos en la tabla usuario
                    $id_insertado = LoginController::ctrRegistrarUsuario($tabla, $datos_usuario);

                    // Sacamos el id del rol
                    $RolesController = new RolesController();
                    $rol =  $RolesController->ctrMostrarRegistroWhere("roles", "nombre_rol", $_POST["rol"]);


                    // Construimos los datos para la tabla es_un
                    $datos_es_un = array(
                        "usuario" => $id_insertado,
                        "rol" => $rol["id_rol"]
                    );

                    // Insertamos los datos en la tabla es_un
                    $RolesController->ctrInsertar("es_un", $datos_es_un);

                    if ($rol["id_rol"] == 2) {
                        // Construimos los datos para la tabla imparte
                        $fecha = $_POST["fecha_imparte"];
                        $hora = $_POST["hora_imparte"];
                
                        $fechaHora = $fecha . ' ' . $hora;
                
                        // Convierte la fecha y hora en un objeto DateTime
                        $dateTime = new DateTime($fechaHora);

                        $datos_imparte = array(
                            "asignatura" => $_POST["asignaturas"],
                            "profesor" => $id_insertado,
                            "precio" => $_POST["precio"],
                            "fecha_imparte" => $dateTime->format('Y-m-d H:i:s')
                        );

                        // Insertamos los datos en la tabla imparte
                        $asignaturasController = new AsignaturasController();
                        $asignaturasController->ctrInsertar("imparte", $datos_imparte,null);
                    }

                    if ($id_insertado) {
                        $respuesta = "";
                        echo "<script>
                                async function showSuccessAlert() {
                                    await Swal.fire({
                                        position: 'top-center',
                                        icon: 'success',
                                        title: 'Usuario Registrado',
                                        showConfirmButton: false,
                                        timer: 1400
                                    });
                                }
                                showSuccessAlert();
                            </script>";
                    } else {
                        $respuesta =  '<br><div class="alert alert-danger">¡Error al guardar el usuario!</div>';
                    }
                } else {
                    $respuesta =  '<br><div class="alert alert-danger">¡El usuario no puede ir vacío o llevar caracteres especiales!</div>';
                }
            } else {
                $respuesta =  '<br><div class="alert alert-danger">¡El usuario ya existe!</div>';
            }

            return $respuesta;
        }
    }

    public function ctrComprobar_Exisitencia_Registro($tabla, $columna, $registro)
    {

        $respuesta = LoginModel::mdlComprobar_Exisitencia_Registro($tabla, $columna, $registro);
        return $respuesta;
    }

    public function ctrfiltrarVarchar($texto)
    {

        $respuesta = LoginModel::mdlfiltrarVarchar($texto);
        return $respuesta;
    }

    public function ctrfiltrarCorreo($correo)
    {

        $respuesta = LoginModel::mdlfiltrarCorreo($correo);
        return $respuesta;
    }

    public function ctrRegistrarUsuario($tabla, $datos)
    {

        $respuesta = LoginModel::mdlRegistrarUsuario($tabla, $datos);
        return $respuesta;
    }

    public function ctrMostrar_Ultimo_Registro($tabla, $id)
    {

        $respuesta = LoginModel::mdlMostrar_Ultimo_Registro($tabla, $id);
        return $respuesta;
    }
}
