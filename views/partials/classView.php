    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Nuestras Clases</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="">Home</a></p>
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
          <?php foreach ($areasAcademicas as $areaAcademica) { ?>
            <div class="col-lg-4 mb-5">
              <div class="card border-0 bg-light shadow-sm pb-2">
                <img class="card-img-top mb-2" src="views/img/class-<?= rand(1,3);?>.jpg" alt="" />
                <div class="card-body text-center">
                  <h4 class="card-title"><?= $areaAcademica["nombre_area"] ?></h4>
                  <p class="card-text"><?= $areaAcademica["descripcion_area"] ?></p>
                </div>
                <a href="" class="btn btn-primary px-4 mx-auto mb-4">Reservar ahora</a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Class End -->