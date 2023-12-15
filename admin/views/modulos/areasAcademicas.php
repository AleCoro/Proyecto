<?php
$areasAcademicasController = new AreasAcademicasController();
$asignaturasController = new AsignaturasController();

$datosAreasAcademicas = $areasAcademicasController->ctrMostrarAreasAcademicas("areas_academicas");


if (isset($_POST["accion"]) && $_POST["accion"] == "InsertarArea") {
    $datos = array(
        "nombre_area" => $_POST["add_nombre"],
        "descripcion_area" => $_POST["add_descripcion"]
    );

    $id_area = $areasAcademicasController->ctrInsertar("areas_academicas", $datos, "areasAcademicas");

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
                $ruta = "views/img/areasAcademicas/" . $id_area . "-" . $_POST["add_nombre"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["add_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/areasAcademicas/" . $id_area . "-" . $_POST["add_nombre"] . ".png";
                $origen = imagecreatefrompng($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
            $datos["portada_area"] = $ruta;

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
                            window.location.href = 'areasAcademicas';
                        }
                        showSuccessAlert();
                    </script>";
                $datos["portada_area"] = null;
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
                        window.location.href = 'areasAcademicas';
                    }
                    showSuccessAlert();
                </script>";
        }
    }

    if (!isset($datos["portada_area"])) {
        $areasAcademicasController->ctrEliminar("areas_academicas", "id_area", $id_area);
    } else {
        $areasAcademicasController->ctrActualizar("areas_academicas", $datos, $id_area);
        echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Area Academica Creada',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'areasAcademicas';
                }
                showSuccessAlert();
            </script>";
    }
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EditarArea") {
    $datos = array(
        "nombre_area" => $_POST["edit_nombre"],
        "descripcion_area" => $_POST["edit_descripcion"]
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
                $ruta = "views/img/areasAcademicas/" . $id . "-" . $_POST["edit_nombre"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["edit_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["edit_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/areasAcademicas/" . $id . "-" . $_POST["edit_nombre"] . ".png";
                $origen = imagecreatefrompng($_FILES["edit_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
            $datos["portada_area"] = $ruta;

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
                            window.location.href = 'areasAcademicas';
                        }
                        showSuccessAlert();
                    </script>";
                $datos["portada_area"] = null;
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
                        window.location.href = 'areasAcademicas';
                    }
                    showSuccessAlert();
                </script>";
        }
    }

    $areasAcademicasController->ctrActualizar("areas_academicas", $datos, $id);

    echo "<script>
            async function showSuccessAlert() {
                await Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Area Academica Actualizado',
                    showConfirmButton: false,
                    timer: 1400
                });
                window.location.href = 'areasAcademicas';
            }
            showSuccessAlert();
        </script>";
}

if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarArea") {
    // Buscamos las asignaturas de ese area
    $asignaturasPorArea = $asignaturasController->ctrMostrarAsignaturasWhere("asignaturas", "area_academica", $_POST["id_area"]);
    // Recorremos las asignaturas
    foreach ($asignaturasPorArea as $asignatura) {
        // borramos de la tabla imparte los registros que coincidan con la asignatura
        $asignaturasController->ctrEliminar("imparte", "asignatura", $asignatura["id_asignatura"], "areasAcademicas");
    }
    // Eliminamos esa asignatura
    $asignaturasController->ctrEliminar("asignaturas", "area_academica", $_POST["id_area"], "areasAcademicas");
    // Eliminamos el areaAcademica
    $areasAcademicasController->ctrEliminar("areas_academicas", "id_area", $_POST["id_area"], "areasAcademicas");

    if (isset($_POST["img"]) && $_POST["img"] != "") {
        unlink($_POST["img"]);
    }

    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Area Academica Eliminada',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'areasAcademicas';
        }
        showSuccessAlert();
    </script>";
}



include("views/partials/areasAcademicas.View.php");
