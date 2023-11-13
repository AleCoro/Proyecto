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

                                    <img class="rounded-circle shadow-1-strong mr-3" src="<?= "admin/".$_SESSION["foto"]; ?>" alt="avatar" width="40" height="40" />
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
                                                    <img class="rounded-circle shadow-1-strong mr-3" src="<?= "admin/".$comentario["foto"]; ?>" alt="avatar" width="60" height="60" />
                                                    <div>
                                                        <h6 class="fw-bold text-primary mb-1"><?= $comentario["usuario"]; ?></h6>
                                                        <p class="text-muted small mb-0">
                                                            <?= $comentario["fecha_comentario"]; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <p class="mt-3 mb-4 pb-2">
                                                    <?= $comentario["comentario"]; ?>
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