<?php
$postController = new PostsController();
$posts = $postController->ctrMostrarPosts("post");

// Crear Post
if (isset($_POST["accion"]) && $_POST["accion"] == "CrearPost") {
    $datos["titulo"] = $_POST["add_titulo"];
    $datos["descripcion"] = $_POST["add_descripcion"];
    $datos["imagen"] = "";
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
    }else {
        $datos["contenido"] = $_POST["add_contenido"];
    }

    $id_post = $postController->ctrInsertar("post", $datos, null);

    if (isset($_FILES["add_portada"]["tmp_name"]) && $_FILES["edit_portada"]["tmp_name"] !== "") {

        list($ancho, $alto) = getimagesize($_FILES["add_portada"]["tmp_name"]);
        $nuevoAncho = 600;
        $nuevoAlto = 400;

        // // CREAMOS EL DIRECTORIO DONDE GUARDAR LA FOTO
        // $directorio = "views/img/blog/".$id_post."-".$_POST["add_titulo"];
        // mkdir($directorio, 0755);

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
    }

    $datos["imagen"] = $ruta;
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

// Eliminar Post
if (isset($_POST["accion"]) && $_POST["accion"] == "EliminarPost") {
    if (isset($_POST["img"]) && $_POST["img"] != "") {
        unlink($_POST["img"]);
    }

    $postController->ctrEliminar("post", "id_post", $_POST["id_post"], null);
}

// Editar Post
if (isset($_POST["accion"]) && $_POST["accion"] == "EditarPost") {
    $id_post = $_POST["edit_id"];
    $datos["titulo"] = $_POST["edit_titulo"];
    $datos["descripcion"] = $_POST["edit_descripcion"];
    $datos["contenido"] = $_POST["edit_contenido"];

    var_dump($_FILES["edit_portada"]["tmp_name"]);

    if (isset($_FILES["edit_portada"]["tmp_name"]) && $_FILES["edit_portada"]["tmp_name"] !== "") {

        unlink($_POST["img_old"]);

        list($ancho, $alto) = getimagesize($_FILES["edit_portada"]["tmp_name"]);
        $nuevoAncho = 600;
        $nuevoAlto = 400;

        // SEGUN FORMATO DE FOTO APLICAMOS UNAS FUNCIONES U OTRAS
        if ($_FILES["edit_portada"]["type"] == "image/jpeg") {

            // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            $ruta = "views/img/blog/" . $id_post . "-" . $_POST["edit_titulo"] . ".jpeg";
            $origen = imagecreatefromjpeg($_FILES["edit_portada"]["tmp_name"]);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagejpeg($destino, $ruta);
        }

        if ($_FILES["edit_portada"]["type"] == "image/png") {

            // GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            $ruta = "views/img/blog/" . $id_post . "-" . $_POST["add_titulo"] . ".png";
            $origen = imagecreatefrompng($_FILES["add_portada"]["tmp_name"]);
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            imagepng($destino, $ruta);
        }
        $datos["imagen"] = $ruta;
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
