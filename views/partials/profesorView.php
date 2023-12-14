<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
    <h3 class="display-3 font-weight-bold text-white"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></h3>
    <div class="d-inline-flex text-white">
      <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
      <p class="m-0 px-2">/</p>
      <p class="m-0"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></p>
    </div>
  </div>
</div>
<!-- Header End -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="<?= "admin/" . $profesor["foto"] ?>" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?= $profesor["nombre"] . " " . $profesor["apellidos"] ?></h3><br>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Total alumnos</b> <a class="float-right"><?= $totalAlumnos; ?></a>
              </li>
              <li class="list-group-item">
                <b>Total profesores</b> <a class="float-right"><?= $totalProfesor; ?></a>
              </li>
              <li class="list-group-item">
                <b>Valoraciones</b> <a class="float-right"><?= $totalValoraciones; ?></a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sobre mi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Asignaturas</strong>

            <p class="text-muted">
              <?= (isset($asignaturasImpartidas["todasAsignaturas"])) ? $asignaturasImpartidas["todasAsignaturas"] : "Aun no ha impartido clases" ; ?>
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted"><?= $profesor["direccion"]; ?></p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Temas</strong>

            <p class="text-muted">
              <span class="tag tag-danger"><?= (isset($asignaturasImpartidas["todosTemas"])) ? $asignaturasImpartidas["todosTemas"] : "Aun no ha impartido clases" ; ?></span>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#calendario" data-toggle="tab">Disponibilidad</a></li>
              <li class="nav-item"><a class="nav-link" href="#valoraciones" data-toggle="tab">Valoraciones</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="calendario">
                <div id="calendarioReserva"></div>
              </div>
              <div class="tab-pane" id="valoraciones">
                <div class="row">
                  <?php if ($totalValoraciones == 0) { ?>
                    <h3 class="ml-2">Aun no te han valorado.</h3>
                    <?php } else {
                    foreach ($valoraciones as $valoracion) { ?>
                      <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-info"> <img class="info-box-icon h-100 w-100" src="<?= "admin/" . $valoracion["foto"] ?>" alt=""></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Alumno: <?= $valoracion["nombre"] . " " . $valoracion["apellidos"] ?></span>
                            <span class="info-box-text">Clase: <?= $valoracion["nombre_asignatura"] ?></span>
                            <div class="d-flex d-inline info-box-text mt-1">
                              <div class="valoracion justify-content-left" id="valoracion">
                                <?php for ($i = 5; $i >= 1; $i--) { ?>
                                  <span class="fa fa-star starShow <?= $i <= $valoracion["valoracion"] ? 'active' : ''; ?>" data-value="<?= $i; ?>"></span>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                      </div>
                  <?php }
                  } ?>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  cargarCalendario(<?= $profesor["id_usuario"] ?>);
</script>

<!-- Modal -->
<div class="modal fade" id="modalReserva" tabindex="-1" role="dialog" aria-labelledby="nombreAsignatura" aria-hidden="true">
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nombreAsignatura" name="nombreAsignatura">Título del Modal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="descripcion">
          <h5 id="mensaje">Contenido del modal. Puedes agregar texto, imágenes u otros elementos aquí.</h5>
          <div class="form-group">
            <label>Selecciona los temas que quieras ver en la clase</label>
            <div class="select2-cyan">
              <select class="select2" required multiple="multiple" id="temas" name="temas[]" data-placeholder="Selecciona el tema" style="width: 100%;">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Reservar</button>
        </div>
      </div>
    </div>
    <input type="hidden" name="accion" value="reservar">
    <input type="hidden" id="id_alumno" name="id_alumno" value="<?php echo (isset($_SESSION["id_usuario"])) ? $_SESSION["id_usuario"] : ""; ?>">
    <input type="hidden" id="id_profesor" name="id_profesor" value="<?= $profesor["id_usuario"]; ?>">
    <input type="hidden" id="id_asignatura" name="id_asignatura" value="">
    <input type="hidden" id="precio" name="precio" value="">
    <input type="hidden" id="fecha_clase" name="fecha_clase" value="">
    <input type="hidden" id="id_imparte" name="id_imparte" value="">
  </form>
</div>

<!-- Formulario -->
<form action="login" id="formReserva" method="post" class="d-none">
  <input type="hidden" name="accion" value="reserva">
  <input type="hidden" name="profesor" id="id_profesor_redireccion" value="">
</form>