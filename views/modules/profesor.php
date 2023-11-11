<?php

if (isset($_POST["id_profesor"])) {
    $usuariosController = new UsuariosController();
    $asignaturasController = new AsignaturasController();
    $reservasController = new ReservasController();
    $rolesController = new RolesController();
    $profesor = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $_POST["id_profesor"]);

    if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] == "addRolUser") {
        $datos["usuario"] = $_SESSION["id_usuario"];
        $datos["rol"] = "3";

        $existe = $rolesController->ctrComprobarRolUsuario("es_un",$datos["usuario"],$datos["rol"]);
        $_SESSION["perfilSeleccionado"] = "3";

        if ($existe == false) {
            $rolesController->ctrInsertar("es_un", $datos);
        }
    }

    if (isset($_POST["accion"]) && $_POST["accion"] == "reservar") {

        // Todo usuario que no sea alumno le saltara el error
        if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] !== "3") {
            echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Debes entrar con el rol de alumno',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'team';
                }
                showSuccessAlert();
            </script>";
        }

        // Si el usuario es alumno de deja reservar
        if (isset($_SESSION["perfilSeleccionado"]) && $_SESSION["perfilSeleccionado"] == "3") {

            if ($_POST["id_alumno"] == $_POST["id_profesor"]) {
                echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'No puedes reservar tu propia clase',
                            showConfirmButton: false,
                            timer: 1400
                        });
                        window.location.href = 'team';
                    }
                    showSuccessAlert();
                </script>";
            } else {
                $datos["alumno"] = $_POST["id_alumno"];
                $datos["profesor"] = $_POST["id_profesor"];
                $datos["asignatura"] = $_POST["id_asignatura"];

                // Elimina la información de la zona horaria
                $fecha_clase_str = preg_replace('/\s\([^)]+\)/', '', $_POST["fecha_clase"]);

                // Crea un objeto DateTime a partir de la cadena modificada
                $fecha_clase = new DateTime($fecha_clase_str);

                // Convierte la fecha en un formato de base de datos (por ejemplo, formato MySQL)
                $datos["fecha_clase"] = $fecha_clase->format('Y-m-d H:i');
                //Inserto los datos de la reserva
                $reservasController->ctrInsertar("reservas", $datos, "team");
                // Actualizo la disponibilidad de la tabla imparte
                $actualizar_datos["disponibilidad"] = "1";
                // var_dump($actualizar_datos);
                $asignaturasController->ctrActualizar("imparte", $actualizar_datos, null, "id_imparte", $_POST["id_imparte"]);
            }
        }
    }
} else {
    echo "<script> window.location.href = 'inicio'; </script>";
}





include("views/partials/profesorView.php");
