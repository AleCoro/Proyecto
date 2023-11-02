    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Our Teachers</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Our Teachers</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Team Start -->
    <section class="content">
      <!-- Default box -->
      <div class="form-row ml-5 mr-5 justify-content-center mb-5">
        <div class="form-group col-md-3">
          <label>Selecciona el area academica</label>
          <select name="areaAcademica" id="areaAcademica" class="form-control" onchange="cargarAsignaturas(true);">
            <option value="" selected>Selecciona</option>
            <?php foreach ($areasAcademicas as $areaAcademica) { ?>
              <option value="<?= $areaAcademica["id_area"] ?>" <?= (isset($_POST["id_area"]) && $areaAcademica["id_area"] == $_POST["id_area"]) ? "selected" : ""; ?>><?= $areaAcademica["nombre_area"] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label>Selecciona la asignatura</label>
          <select name="asignaturas" id="asignaturas" class="form-control" onchange="cargarAsignaturas(this.value);">
            <option value="" selected>Selecciona</option>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label>Precio/hora</label>
          <input type="number" class="form-control" name="precio" placeholder="Precio" min="0">
        </div>
      </div>

      <div class="row" style="margin-left: 8em; margin-right: 8em;">
        <?php foreach ($profesores as $profesor) { ?>

          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-2" id="card_<?= $profesor["id_usuario"] ?>">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?= $profesor["usuario"]; ?>
              </div>
              <div class="card-body pt-0">
                <div class="row mt-3">
                  <div class="col-8">
                    <h2 class="lead"><b><?= $profesor["nombre"] . " " . $profesor["apellidos"]; ?></b></h2>
                    <p class="text-muted text-sm"><b>Asignaturas: </b> <?= $profesor["todasAsignaturas"]; ?> </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Direccion: <?= $profesor["direccion"]; ?></li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono: <?= $profesor["telefono"] ?></li>
                    </ul>
                  </div>
                  <div class="col-4 text-center">
                    <img src="views/img/team-<?= rand(1, 4); ?>.jpg" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <form action="profesor" method="post" class="m-auto">
                    <input type="hidden" name="id_profesor" value="<?= $profesor["id_usuario"]; ?>">
                    <button class="btn btn-sm btn-primary"><i class="fas fa-user"></i> Ver mas...</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        <?php } ?>
      </div>
    </section>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
      <div class="container p-0">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Testimonial</span>
          </p>
          <h1 class="mb-4">What Parents Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img class="rounded-circle" src="views/img/testimonial-1.jpg" style="width: 70px; height: 70px" alt="Image" />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img class="rounded-circle" src="views/img/testimonial-2.jpg" style="width: 70px; height: 70px" alt="Image" />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img class="rounded-circle" src="views/img/testimonial-3.jpg" style="width: 70px; height: 70px" alt="Image" />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img class="rounded-circle" src="views/img/testimonial-4.jpg" style="width: 70px; height: 70px" alt="Image" />
              <div class="pl-3">
                <h5>Parent Name</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Testimonial End -->

    <script>
      window.addEventListener('load', function() {
        cargarAsignaturas();
      });
    </script>