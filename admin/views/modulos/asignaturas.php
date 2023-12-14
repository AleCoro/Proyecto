<?php

$asignaturasController = new AsignaturasController();
$areasAcademicasController = new AreasAcademicasController();

$datosAsignaturas = $asignaturasController->ctrMostrarAsignaturas("asignaturas");

// &$dato se utilizar para guardar los cambios en la variable $datosAsignaturas sin "&" no se veria reflejado en la variable principal
foreach ($datosAsignaturas as &$dato) {

    $area = $areasAcademicasController->ctrMostrarAreaAcademicaWhere("areas_academicas", "id_area", $dato["area_academica"]);
    $dato["nombre_area"] = $area["nombre_area"];
}
unset($dato);


if (isset($_POST["accion"]) && $_POST["accion"] == "InsertarAsignatura") {
    $datos = array(
        "nombre_asignatura" => $_POST["add_nombre"],
        "area_academica" => $_POST["add_area"]
    );

    $id_asignatura = $asignaturasController->ctrInsertar("asignaturas", $datos, "asignaturas");

    // Valido el fichero
    if (isset($_FILES["add_portada"]["tmp_name"]) && $_FILES["add_portada"]["tmp_name"] !== "") {
        //Definimo el tamaño maximo de megas
        $sizeMegas = 2;
        $sizeMegas = $sizeMegas * 1048576;
        //Sacamos el tamaño de nuestro fichero
        $size = filesize($_FILES["add_portada"]["tmp_name"]);

        if ($size < $sizeMegas) {

            list($ancho, $alto) = getimagesize($_FILES["add_portada"]["tmp_name"]);
            $nuevoAncho = 600;
            $nuevoAlto = 400;

            // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
            if ($_FILES["add_portada"]["type"] == "image/jpeg") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/asignaturas/" . $id_asignatura . "-" . $_POST["add_nombre"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["add_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/asignaturas/" . $id_asignatura . "-" . $_POST["add_nombre"] . ".png";
                $origen = imagecreatefrompng($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
            $datos["portada_asignatura"] = $ruta;

            if (!isset($destino)) {
                echo "<script>
                            async function showSuccessAlert() {
                                await Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: 'Tipo de fichero incorrecto',
                                    showConfirmButton: false,
                                    timer: 1400
                                });
                                window.location.href = 'asignaturas';
                            }
                            showSuccessAlert();
                        </script>";
                $datos["portada_asignatura"] = null;
            }
        } else {
            echo "<script>
                        async function showSuccessAlert() {
                            await Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Fichero demasiado grande',
                                showConfirmButton: false,
                                timer: 1400
                            });
                            window.location.href = 'asignaturas';
                        }
                        showSuccessAlert();
                    </script>";
        }
    }

    if (!isset($datos["portada_asignatura"])) {
        $asignaturasController->ctrEliminar("asignaturas", "id_asignatura", $id_asignatura, null);
    } else {
        $asignaturasController->ctrActualizar("asignaturas", $datos, null, $id_asignatura);
        echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Asignatura Creada',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'asignaturas';
                }
                showSuccessAlert();
            </script>";
    }
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EditarAsignatura") {
    $datos = array(
        "nombre_asignatura" => $_POST["edit_nombre"],
        "area_academica" => $_POST["edit_area"]
    );

    $id = $_POST["edit_id"];

    if (isset($_FILES["edit_portada"]["tmp_name"]) && $_FILES["edit_portada"]["tmp_name"] !== "") {
        //Definimo el tamaño maximo de megas
        $sizeMegas = 2;
        $sizeMegas = $sizeMegas * 1048576;
        //Sacamos el tamaño de nuestro fichero
        $size = filesize($_FILES["edit_portada"]["tmp_name"]);

        if ($size < $sizeMegas) {

            list($ancho, $alto) = getimagesize($_FILES["edit_portada"]["tmp_name"]);
            $nuevoAncho = 600;
            $nuevoAlto = 400;

            // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
            if ($_FILES["edit_portada"]["type"] == "image/jpeg") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/asignaturas/" . $id . "-" . $_POST["edit_nombre"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["edit_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            var_dump($_FILES["edit_portada"]["type"]);
            if ($_FILES["edit_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/asignaturas/" . $id . "-" . $_POST["edit_nombre"] . ".png";
                $origen = imagecreatefrompng($_FILES["edit_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
            $datos["portada_asignatura"] = $ruta;

            if (!isset($destino)) {
                echo "<script>
                        async function showSuccessAlert() {
                            await Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Tipo de fichero incorrecto',
                                showConfirmButton: false,
                                timer: 1400
                            });
                            window.location.href = 'asignaturas';
                        }
                        showSuccessAlert();
                    </script>";
                $datos["portada_asignatura"] = null;
            }
        } else {
            echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Fichero demasiado grande',
                            showConfirmButton: false,
                            timer: 1400
                        });
                        window.location.href = 'asignaturas';
                    }
                    showSuccessAlert();
                </script>";
        }
    }

    $asignaturasController->ctrActualizar("asignaturas", $datos, "asignaturas", $id);

    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Asignatura Acturalizada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'asignaturas';
        }
        showSuccessAlert();
    </script>";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarAsignatura") {

    // Eliminamos de la tabla imparte los registros que coincidan con la asignatura
    $asignaturasController->ctrEliminar("imparte", "asignatura", $_POST["id_asignatura"], "asignaturas");
    // Eliminamos esa asignatura
    $asignaturasController->ctrEliminar("asignaturas", "id_asignatura", $_POST["id_asignatura"], "asignaturas");

    if (isset($_POST["img"]) && $_POST["img"] != "") {
        unlink($_POST["img"]);
    }


    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Asignatura Eliminada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'asignaturas';
        }
        showSuccessAlert();
    </script>";
}

$areasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");

include("views/partials/asignaturas.View.php");
