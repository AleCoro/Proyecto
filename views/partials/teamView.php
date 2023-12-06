    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white">Nuestros Profesores</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Nuestros Profesores</p>
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
          <select name="areaAcademica" id="areaAcademica" class="form-control" onchange="cargarAsignaturas('SinAsignatura');">
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
          <input type="number" class="form-control" name="precio" id="precio" placeholder="Precio" min="0" onchange="cargarAsignaturas(document.getElementById('asignaturas').value);">
        </div>
      </div>

      <div class="row justify-content-center">
        <h4 class="section-title px-5 pb-3">
          <span class="px-2" id="tituloProfesores"></span>
        </h4>
      </div>



      <div class="row" style="margin-left: 8em; margin-right: 8em;">
        <?php foreach ($profesores as $profesor) { ?>

          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column mb-2" id="card_<?= $profesor["id_imparte"] ?>">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                <?= $profesor["usuario"]; ?>
              </div>
              <div class="card-body pt-0">
                <div class="row mt-3">
                  <div class="col-8">
                    <h2 class="lead"><b><?= $profesor["nombre"] . " " . $profesor["apellidos"]; ?></b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-graduation-cap"></i></span> Asignatura: <?= $profesor["nombre_asignatura"]; ?></li>
                      <li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> Fecha: <?= $reservasController->formatearFecha($profesor["fecha_imparte"]); ?></li>
                      <li class="small mb-2"><span class="fa-li"><i class="fas fa-lg fa-euro-sign"></i></span> Precio: <?= $profesor["precio"] ?> €</li>
                    </ul>
                  </div>
                  <div class="col-4 text-center">
                    <img src="<?= "admin/" . $profesor["foto"] ?>" alt="user-avatar" class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <form action="profesor" method="post" class="m-auto">
                    <input type="hidden" name="id_profesor" value="<?= $profesor["id_usuario"]; ?>">
                    <input type="hidden" name="id_imparte" id="id_imparte" value="<?= $profesor["id_imparte"]; ?>">
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

    <?php
    if (isset($_POST["id_area"]) && !empty($_POST["id_area"])) {
      //Profesores filtrados por area
      echo "<script>cargarAsignaturas('SinAsignatura','" . $_POST["id_area"] . "')</script>";
    } else {
      //Todos los profesores
      echo "<script>cargarAsignaturas('SinAsignatura','SinArea')</script>";
    }

    if (isset($_POST["id_asignatura"]) && !empty($_POST["id_asignatura"])) {
      //Profesores filtrados por asignatura
      echo "<script>cargarAsignaturas('" . $_POST["id_asignatura"] . "','SinArea')</script>";
    } else {
      //Todos los profesores
      echo "<script>cargarAsignaturas('SinAsignatura','SinArea')</script>";
    }
    ?>