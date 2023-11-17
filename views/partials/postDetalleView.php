<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Nuestro Blog</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Nuestro Blog</p>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5">
                <span class="px-2">Detalle del post</span>
            </p>
        </div>
        <div class="row">

            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1"><?= $post["titulo"]; ?></h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2"><?= $post["fecha_publicacion"]; ?></div>
                                <!-- Post categories-->
                                <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                                <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded m-auto w-100" src="<?= "admin/" . $post["imagen"]; ?>" alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-0">
                                <p class="fs-5 mb-0"><?= $post["contenido"]; ?></p>
                            </section>
                            <!-- Comentarios y likes -->
                            <div class="big d-flex justify-content-end mb-3">
                                <?php if (isset($like) && $like == true) { ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_like" value="<?= $id_like; ?>">
                                        <input type="hidden" name="accion" value="dislike">

                                        <button type="submit" class="btn btn-dark d-flex align-items-center mr-3">
                                            <i class="far fa-thumbs-up mr-2 text-lg"></i>
                                            <p class="mb-0"><?= $numLikes["totalLikes"]; ?></p>
                                        </button>
                                    </form>
                                <?php } else { ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_post" value="<?= $_SESSION["id_post"] ?>">
                                        <input type="hidden" name="accion" value="like">

                                        <button type="submit" class="btn btn-primary d-flex align-items-center mr-3">
                                            <i class="far fa-thumbs-up mr-2 text-lg"></i>
                                            <p class="mb-0"><?= $numLikes["totalLikes"]; ?></p>
                                        </button>
                                    </form>
                                <?php }
                                ?>



                                <button class="btn btn-primary d-flex align-items-center mr-3" onclick="mostrarComentarios()">
                                    <i class="far fa-comment-dots mr-2 text-lg"></i>
                                    <p class="mb-0"><?= $numComentarios["totalComentarios"]; ?></p>
                                </button>
                            </div>
                        </article>
                        <?php if (isset($_SESSION["id_usuario"])) { ?>
                            <form action="" method="post">
                                <input type="hidden" name="id_post" value="<?= $_SESSION["id_post"] ?>">
                                <input type="hidden" name="accion" value="comentar">
                                <div class="d-flex flex-start w-100">

                                    <img class="rounded-circle shadow-1-strong mr-3" src="<?= "admin/" . $_SESSION["foto"]; ?>" alt="avatar" width="40" height="40" />
                                    <div class="form-outline w-100">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="4" style="background: #fff;"></textarea>
                                    </div>

                                </div>
                                <div class="float-end mt-2 pt-1 mb-5">
                                    <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
                                </div>
                            <?php } ?>
                            </form>

                            <!-- Comments section-->
                            <div class="container d-none" id="comentarios">
                                <div class="row d-flex justify-content-center">
                                    <div class="card w-100">
                                        <div class="card-header">
                                            <h3>Comentarios</h3>
                                        </div>
                                        <!-- Comentarios inicio -->
                                        <?php foreach ($comentarios as $comentario) { ?>
                                            <div class="card-body">
                                                <div class="d-flex flex-start align-items-center">
                                                    <img class="rounded-circle shadow-1-strong mr-3" src="<?= "admin/" . $comentario["foto"]; ?>" alt="avatar" width="60" height="60" />
                                                    <div>
                                                        <h6 class="fw-bold text-primary mb-1"><?= $comentario["usuario"]; ?></h6>
                                                        <p class="text-muted small mb-0">
                                                            <?= $comentario["fecha_comentario"]; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Comentario -->
                                                <p class="mt-3 mb-4 pb-2" id="campoComentario<?= $comentario['id_comentario']; ?>">
                                                    <?= $comentario["comentario"]; ?>
                                                </p>

                                                <?php if (isset($_SESSION["id_usuario"]) && $comentario["id_usuario"] == $_SESSION["id_usuario"]) { ?>
                                                    <!-- botonesComentario -->
                                                    <div id="botones<?= $comentario['id_comentario']; ?>">

                                                        <div class="small d-flex justify-content-start">
                                                            <button class="btn btn-warning btn-sm d-flex mr-2" onclick="editarComentario(<?= $comentario['id_comentario']; ?>)">
                                                                <i class="fas fa-pen mr-1"></i>
                                                                <p class="mb-0">Editar</p>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm d-flex" onclick="borrarComentario(<?= $comentario['id_comentario']; ?>)">
                                                                <i class="fas fa-trash mr-1"></i>
                                                                <p class="mb-0">Borrar</p>
                                                            </button>
                                                        </div>

                                                    </div>
                                                <?php } ?>

                                                <!-- formularioEditar -->
                                                <form action="" method="post" id="formularioEditarComentario<?= $comentario['id_comentario']; ?>" class="d-none mt-3 pb-2">
                                                    <input type="hidden" name="accion" id="accion" value="editarComentario">
                                                    <input type="hidden" name="id_comentario" value="<?= $comentario['id_comentario']; ?>">
                                                    <div class="form-group">
                                                        <input id="my-input" class="form-control" type="text" name="editComentario" value="<?= $comentario["comentario"]; ?>">
                                                    </div>
                                                </form>
                                                <!-- formularioBorrar -->
                                                <form action="" method="post" id="formularioBorrarComentario<?= $comentario['id_comentario']; ?>" class="d-none mt-3 pb-2">
                                                    <input type="hidden" name="accion" id="accion" value="borrarComentario">
                                                    <input type="hidden" name="id_comentario" value="<?= $comentario['id_comentario']; ?>">
                                                </form>
                                                <!-- botonesFormulario -->
                                                <div class="d-none" id="botonesFormulario<?= $comentario['id_comentario']; ?>">
                                                    <div class="d-flex">
                                                        <button class="btn btn-success btn-sm d-flex mr-2" onclick="guardarComentario(<?= $comentario['id_comentario']; ?>)">
                                                            <i class="fas fa-check mr-1"></i>
                                                            <p class="mb-0">Guardar</p>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm d-flex" onclick="cancelarEditComentario(<?= $comentario['id_comentario']; ?>)">
                                                            <i class="fas fa-arrow-rotate-left mr-1"></i>
                                                            <p class="mb-0">Cancelar</p>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                        <!-- <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <img class="rounded-circle shadow-1-strong mr-3" src="views/img/team-1.jpg" alt="avatar" width="60" height="60" />
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                                                <p class="text-muted small mb-0">
                                                    Shared publicly - Jan 2020
                                                </p>
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                                        </p>

                                        <div class="small d-flex justify-content-start">
                                            <a href="#!" class="d-flex align-items-center mr-3">
                                                <i class="far fa-thumbs-up me-2"></i>
                                                <p class="mb-0">Like</p>
                                            </a>
                                            <a href="#!" class="d-flex align-items-center mr-3">
                                                <i class="far fa-comment-dots me-2"></i>
                                                <p class="mb-0">Comment</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-start align-items-center">
                                            <img class="rounded-circle shadow-1-strong mr-3" src="views/img/team-1.jpg" alt="avatar" width="60" height="60" />
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                                                <p class="text-muted small mb-0">
                                                    Shared publicly - Jan 2020
                                                </p>
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                                        </p>

                                        <div class="small d-flex justify-content-start">
                                            <a href="#!" class="d-flex align-items-center mr-3">
                                                <i class="far fa-thumbs-up me-2"></i>
                                                <p class="mb-0">Like</p>
                                            </a>
                                            <a href="#!" class="d-flex align-items-center mr-3">
                                                <i class="far fa-comment-dots me-2"></i>
                                                <p class="mb-0">Comment</p>
                                            </a>
                                        </div>
                                    </div> -->
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->
<script>
    function editarComentario(id_comentario) {

        formulario = document.getElementById("formularioEditarComentario" + id_comentario);
        formulario.classList.remove("d-none");

        formulario = document.getElementById("botonesFormulario" + id_comentario);
        formulario.classList.remove("d-none");

        campoComentario = document.getElementById("campoComentario" + id_comentario);
        campoComentario.classList.add("d-none");

        botones = document.getElementById("botones" + id_comentario);
        botones.classList.add("d-none");
    }

    function cancelarEditComentario(id_comentario) {
        formulario = document.getElementById("formularioEditarComentario" + id_comentario);
        formulario.classList.add("d-none");

        formulario = document.getElementById("botonesFormulario" + id_comentario);
        formulario.classList.add("d-none");

        campoComentario = document.getElementById("campoComentario" + id_comentario);
        campoComentario.classList.remove("d-none");

        botones = document.getElementById("botones" + id_comentario);
        botones.classList.remove("d-none");
    }

    function borrarComentario(id_comentario) {
        document.getElementById("formularioBorrarComentario"+id_comentario).submit();
    }

    function guardarComentario(id_comentario) {
        document.getElementById("formularioEditarComentario"+id_comentario).submit();
    }
</script>