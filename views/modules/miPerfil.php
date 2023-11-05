<?php
    $usuariosController = new UsuariosController();
    $rolesController = new RolesController();
    $areasAcademicasController = new AreasAcademicasController();
    $asignaturasController = new AsignaturasController();
    // $reservasController = new ReservasController();

    $usuario = $usuariosController->ctrMostrarUsuarioWhere("id_usuario", $_SESSION["id_usuario"]);
    $rolesUsuario = $rolesController->ctrMostrarRegistrosWhere("es_un","usuario",$usuario["id_usuario"]);

    if ($_SESSION["perfilSeleccionado"]==2) {
        $datosProfesor = $usuariosController->ctrDatosProfesor($_SESSION["id_usuario"]);
    }
    if ($_SESSION["perfilSeleccionado"]==3) {
        $datosAlumno = $usuariosController->ctrDatosAlumno($_SESSION["id_usuario"]);
    }

    foreach ($rolesUsuario as $rolUsuario) {
        $usuarioRoles[] = $rolUsuario["rol"];
    }

    if (isset($_POST["addRol"])) {
        $datos["usuario"] = $_SESSION["id_usuario"];
        $datos["rol"] = $_POST["addRol"];

        $rolesController->ctrInsertar("es_un", $datos);
        echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Ya puedes seleccionar tu rol nuevo',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'miPerfil';
                }
                showSuccessAlert();
            </script>";
    }

    $areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");


    if (isset($_POST["impartir"])) {
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];

        $fechaHora = $fecha . ' ' . $hora;

        // Convierte la fecha y hora en un objeto DateTime
        $dateTime = new DateTime($fechaHora);

        // Formatea la fecha y hora en el formato MySQL DATETIME
        $datos["asignatura"] = $_POST["asignaturas"];
        $datos["profesor"] = $_SESSION["id_usuario"];
        $datos["precio"] = $_POST["precio"];
        $datos["fecha_imparte"] = $dateTime->format('Y-m-d H:i:s');
        var_dump($datos);
        $asignaturasController->ctrInsertar("imparte",$datos,null);
    }


  include("views/partials/miPerfilView.php");