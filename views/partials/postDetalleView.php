<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Nuestro Blog</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Nuestro Blog</p>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Detail Start -->
<div class="container pt-5 pb-0">
    <div class="row pt-5">
        <div class="col-lg-8">
            <div class="d-flex flex-column text-left mb-3">
                <p class="section-title pr-5">
                    <span class="pr-2">Detalle del post</span>
                </p>
                <h1 class="mb-3"><?= $post["titulo"]; ?></h1>
                <div class="d-flex">
                    <p class="mr-3"><i class="fa fa-user text-primary"></i> Admin</p>
                    <p class="mr-3">
                        <i class="fa fa-folder text-primary"></i> Web Design
                    </p>
                    <p class="mr-3"><i class="fa fa-comments text-primary"></i> 15</p>
                </div>
            </div>
            <div class="mb-5">
                <img class="img-fluid rounded w-100 mb-4" src="<?= "admin/" . $post["imagen"]; ?>" alt="Image" />
                <p>
                    <?= $post["contenido"]; ?>
                </p>
            </div>

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


        </div>

        <div class="col-lg-4 mt-5 mt-lg-0">
            <!-- Author Bio -->
            <div class="d-flex flex-column text-center bg-primary rounded mb-5 py-5 px-4">
                <img src="<?= "admin/" . $creador["foto"] ?>" class="img-fluid rounded-circle mx-auto mb-3" style="width: 100px" />
                <h3 class="text-secondary mb-3"><?= $creador["nombre"] . " " . $creador["apellidos"]; ?></h3>
            </div>


            <!-- Single Image -->
            <div class="mb-5">
                <img src="views/img/blog-1.jpg" alt="" class="img-fluid rounded" />
            </div>

            <!-- Recent Post -->
            <div>
                <h2 class="mb-4">Posts Recientes</h2>
                <?php foreach ($ultimosPosts as $ultimoPost) { ?>

                    <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                        <img class="img-fluid" src="<?= "admin/" . $ultimoPost["imagen"]; ?>" style="width: 80px; height: 80px" />
                        <div class="pl-3">
                            <h6 class=""><?= $ultimoPost["titulo"]; ?></h6>
                            <div class="d-flex">
                                <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                                <small class="mr-3"><i class="fa fa-comments text-primary"></i> <?= $ultimoPost["NumComentarios"]; ?></small>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Comment List -->
<div class="mb-5">
    <div class="container" id="comentarios">
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
                                    <?= $postsController->formatearFecha($comentario["fecha_comentario"]); ?>
                                </p>
                            </div>
                        </div>
                        <!-- Comentario -->
                        <p class="mt-3 mb-4 pb-2" id="campoComentario<?= $comentario['id_comentario']; ?>">
                            <?= $comentario["comentario"]; ?>
                        </p>
                        <hr>

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
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        ocultarComentarios();
    });
</script>
<!-- Detail End -->