    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Nuestras Clases</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Nuestras Clases</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Areas Academicas</span>
          </p>
          <h1 class="mb-4">Selecciona una para empezar a aprender</h1>
        </div>
        <div class="row">
          <?php foreach ($areasAcademicasPaginadas as $areaAcademica) { ?>
            <div class="col-lg-4 mb-5">
              <div class="card border-0 bg-light shadow-sm pb-2">
                <img class="card-img-top mb-2" src="views/img/class-<?= rand(1, 3); ?>.jpg" alt="" />
                <div class="card-body text-center">
                  <h4><?= $areaAcademica["nombre_area"] ?></h4>
                  <p class="card-text"><?= $areaAcademica["descripcion_area"] ?></p>
                </div>
                <form action="team" method="post" class="m-auto">
                  <input type="hidden" name="id_area" value="<?= $areaAcademica["id_area"]; ?>">
                  <button class="btn btn-primary px-4 mx-auto mb-4">Ver mas...</button>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- Paginacion -->
      <nav class="blog-pagination justify-content-center d-flex">
        <ul class="pagination">
          <li class="page-item h4">
            <!--Desactivo el boton de atras-->
            <?php if ($pagina <= 1) { ?>
              <a class="page-link text-dark"><i class="fas fa-caret-left"></i></a><!-- &laquo; es el simbolo html para anterior -->
            <?php } else { ?>
              <a class="page-link" href="index.php?ruta=class&pagina=<?= $pagina - 1 ?>"><i class="fas fa-caret-left"></i></a>
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
                <a class="page-link" href="index.php?ruta=class&pagina=<?= $i ?>"><?= $i ?></a>
              </li>
            <?php } ?>
          <?php } ?>
          </li>

          <li class="page-item h4">
            <!--Desactivo el boton de siguiente-->
            <?php if ($pagina >= $paginas) { ?>
              <a class="page-link text-dark"><i class="fas fa-caret-right"></i></a><!-- &raquo; es el simbolo html para siguiente -->
            <?php } else { ?>
              <a class="page-link" href="index.php?ruta=class&pagina=<?= $pagina + 1 ?>"><i class="fas fa-caret-right"></i></a>
            <?php } ?>
          </li>
        </ul>
      </nav>
    </div>
    <!-- Class End -->