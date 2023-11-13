<?php
$postsController = new PostsController();
$usuariosController = new UsuariosController();

if (isset($_POST["id_post"])) {
    $_SESSION["id_post"] = $_POST["id_post"];
}

if (!$_SESSION["id_post"]) {
    header("Location: blog");
}

// Saco la informacion del post
$post = $postsController->ctrMostrarPostWhere("post", "id_post", $_SESSION["id_post"]);

if (isset($_POST["accion"])) {
    if (isset($_SESSION["id_usuario"])) {
        // Dar like
        if ($_POST["accion"] == "like") {
            $datos["post"] = $_SESSION["id_post"];
            $datos["usuario"] = $_SESSION["id_usuario"];
            $postsController->ctrInsertar("likes", $datos, null);
        }
        // Dar dislike
        if ($_POST["accion"] == "dislike") {
            $datos["post"] = $_SESSION["id_post"];
            $datos["usuario"] = $_SESSION["id_usuario"];
            $postsController->ctrEliminar("likes", "id_like", $_POST["id_like"], null);
        }
        //Comentar
        if ($_POST["accion"] == "comentar") {
            $datos["post"] = $_SESSION["id_post"];
            $datos["usuario"] = $_SESSION["id_usuario"];
            $datos["comentario"] = $_POST["comentario"];

            if ($datos["comentario"] !== "") {
                $postsController->ctrInsertar("comentarios", $datos, null);

                echo "<script>
                    async function showSuccessAlert() {
                        await Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Gracias por comentar',
                            showConfirmButton: false,
                            timer: 1400
                        });
                        window.location.href = 'postDetalle';
                    }
                    showSuccessAlert();
                </script>";
            }
        }
    } else {
        echo "<script>
                async function showSuccessAlert() {
                    await Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'Inicia session para dar like y comentar',
                        showConfirmButton: false,
                        timer: 1400
                    });
                    window.location.href = 'login';
                }
                showSuccessAlert();
            </script>";
    }
}

// Saco los comentarios
$comentarios = $postsController->ctrMostrarComentarios($_SESSION["id_post"]);

// Cuento los likes y comentarios
$numComentarios  = $postsController->ctrContarComentarios($_SESSION["id_post"]);
$numLikes = $postsController->ctrContarLikes($_SESSION["id_post"]);

// Compruebo si ya le ha dado like
$comprobarLikes = $postsController->ctrMostrarPostsWhere("likes", "post", $_SESSION["id_post"]);

foreach ($comprobarLikes as $comprobarLike) {
    if ($comprobarLike["usuario"] == $_SESSION["id_usuario"]) {
        $like = true;
        $id_like = $comprobarLike["id_like"];
    }
}






include("views/partials/postDetalleView.php");
