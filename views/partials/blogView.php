    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Nuestro Blog</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Nuestro Blog</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Blog</span>
          </p>
          <h1 class="mb-4">Artículos del blog</h1>
        </div>
        <div class="row pb-3">

          <?php foreach ($postsPaginados as $postPaginados) { ?>
            <div class="col-lg-4 mb-4">
              <div class="card border-0 shadow-sm mb-2">
                <img class="card-img-top mb-2" src="<?= "admin/" . $postPaginados["imagen"]; ?>" alt="" />
                <div class="card-body bg-light text-center p-4">
                  <h4 class=""><?= $postPaginados["titulo"]; ?></h4>
                  <div class="d-flex justify-content-center mb-3">
                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> <?= $postPaginados["NumComentarios"];?></small>
                  </div>
                  <p> <?= $postPaginados["descripcion"]; ?> </p>
                  <form action="postDetalle" method="post">
                    <input type="hidden" name="id_post" value="<?= $postPaginados["id_post"]; ?>">
                    <button type="submit" class="btn btn-primary px-4 mx-auto my-2">Leer Mas</button>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>


        </div>
        <!-- Paginacion -->
        <nav class="blog-pagination justify-content-center d-flex">
          <ul class="pagination">
            <li class="page-item h4">
              <!--Desactivo el boton de atras-->
              <?php if ($pagina <= 1) { ?>
                <a class="page-link text-dark"><i class="fas fa-caret-left"></i></a><!-- &laquo; es el simbolo html para anterior -->
              <?php } else { ?>
                <a class="page-link" href="index.php?ruta=blog&pagina=<?= $pagina - 1 ?>"><i class="fas fa-caret-left"></i></a>
              <?php } ?>
            </li>
            <!--Pongo el numero de paginas que debe tener segun el numero de registros-->
            <?php for ($i = 1; $i <= $paginas; $i++) {
              if ($pagina == $i) { ?>
                <li class="page-item h4">
                  <a class="page-link text-dark"><?= $i ?></a>
                </li>
              <?php } else { ?>
                <li class="page-item h4">
                  <a class="page-link" href="index.php?ruta=blog&pagina=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php } ?>
            <?php } ?>
            </li>

            <li class="page-item h4">
              <!--Desactivo el boton de siguiente-->
              <?php if ($pagina >= $paginas) { ?>
                <a class="page-link text-dark"><i class="fas fa-caret-right"></i></a><!-- &raquo; es el simbolo html para siguiente -->
              <?php } else { ?>
                <a class="page-link" href="index.php?ruta=blog&pagina=<?= $pagina + 1 ?>"><i class="fas fa-caret-right"></i></a>
              <?php } ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Blog End -->