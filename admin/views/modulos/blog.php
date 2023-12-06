<?php
$postController = new PostsController();
$posts = $postController->ctrMostrarPosts("post");

// Crear Post
if (isset($_POST["accion"]) && $_POST["accion"] == "CrearPost") {
    $datos["titulo"] = $_POST["add_titulo"];
    $datos["descripcion"] = $_POST["add_descripcion"];
    // Valido TextArea
    if ($_POST["add_contenido"] == "") {
        echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Text Area Vacio',
                            showConfirmButton: false,
                            timer: 1400
                        });
                        window.location.href = 'blog';
                    }
                    showSuccessAlert();
                </script>";
        return;
    } else {
        $datos["contenido"] = $_POST["add_contenido"];
    }

    $id_post = $postController->ctrInsertar("post", $datos, null);

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
                $ruta = "views/img/blog/" . $id_post . "-" . $_POST["add_titulo"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["add_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/blog/" . $id_post . "-" . $_POST["add_titulo"] . ".png";
                $origen = imagecreatefrompng($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }
            $datos["imagen"] = $ruta;

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
                            window.location.href = 'blog';
                        }
                        showSuccessAlert();
                    </script>";
                $datos["imagen"] = null;
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
                        window.location.href = 'blog';
                    }
                    showSuccessAlert();
                </script>";
        }
    }

    if (!isset($datos["imagen"])) {
        // echo "eliminado";
        $postController->ctrEliminar("post", "id_post", $id_post, null);
    } else {
        // echo "actualizado";
        $postController->ctrActualizar("post", $datos, null, $id_post);

        echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'PostCreado',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'blog';
                }
                showSuccessAlert();
            </script>";
    }
}

// Eliminar Post
if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarPost") {
    if (isset($_POST["img"]) && $_POST["img"] != "") {
        unlink($_POST["img"]);
    }

    $postController->ctrEliminar("post", "id_post", $_POST["id_post"], null);
    echo "<script>
    async function showSuccessAlert() {
        await Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'PostEliminado',
            showConfirmButton: false,
            timer: 1400
        });
        window.location.href = 'blog';
    }
    showSuccessAlert();
</script>";
}

// Editar Post
if (isset($_POST["accion"]) && $_POST["accion"] == "EditarPost") {
    $id_post = $_POST["edit_id"];
    $datos["titulo"] = $_POST["edit_titulo"];
    $datos["descripcion"] = $_POST["edit_descripcion"];
    $datos["contenido"] = $_POST["edit_contenido"];

    // var_dump($_FILES["edit_portada"]["tmp_name"]);

    if (isset($_FILES["add_portada"]["tmp_name"]) && $_FILES["edit_portada"]["tmp_name"] !== "") {
        //Definimo el tamaño maximo de megas
        $sizeMegas = 2;
        $sizeMegas = $sizeMegas * 1048576;
        //Sacamos el tamaño de nuestro fichero
        $size = filesize($_FILES["foto"]["tmp_name"]);

        if ($size < $sizeMegas) {

            list($ancho, $alto) = getimagesize($_FILES["add_portada"]["tmp_name"]);
            $nuevoAncho = 600;
            $nuevoAlto = 400;

            // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
            if ($_FILES["add_portada"]["type"] == "image/jpeg") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/blog/" . $id_post . "-" . $_POST["add_titulo"] . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $ruta);
            }

            if ($_FILES["add_portada"]["type"] == "image/png") {

                // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                $ruta = "views/img/blog/" . $id_post . "-" . $_POST["add_titulo"] . ".png";
                $origen = imagecreatefrompng($_FILES["add_portada"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $ruta);
            }

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
                            window.location.href = 'blog';
                        }
                        showSuccessAlert();
                    </script>";
                return;
            }

            $datos["imagen"] = $ruta;
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
                        window.location.href = 'blog';
                    }
                    showSuccessAlert();
                </script>";
            return;
        }
    }

    $postController->ctrActualizar("post", $datos, null, $id_post);

    echo "<script>
        async function showSuccessAlert() {
            await Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Post Actualizado',
                showConfirmButton: false,
                timer: 1400
            });
            window.location.href = 'blog';
        }
        showSuccessAlert();
    </script>";
}



include("views/partials/blog.View.php");
