<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administración</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Asignaturas</a></li>
            <li class="breadcrumb-item active">Administracion</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" data-toggle="modal" data-target="#formularioInsertarAsignaturaModal">Añadir Asignatura</button>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <!-- <th style="width: 10px;">Nº</th> -->
              <th style="width: 10px;">Id</th>
              <!-- <th>Foto</th> -->
              <th>Nombre</th>
              <th>Area Academica</th>
              <th>Portada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datosAsignaturas as $dato) { ?>
              <tr>
                <td><?= $dato["id_asignatura"]; ?></td>
                <td><?= $dato["nombre_asignatura"]; ?></td>
                <td><?= $dato["nombre_area"]; ?></td>
                <td class="text-center">
                  <img id="imagen-pequena" style="width: 80px; height: 60px;" src="<?= $dato["portada_asignatura"]; ?>" onclick="mostrarIMG(this)">
                </td>
                <td>
                  <div class="form-group d-flex">
                    <button type="button" class="btn btn-warning mr-1" onclick='editarAsignatura(<?= json_encode($dato); ?>)'>
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <form action="" method="post">
                      <input type="hidden" name="id_asignatura" value="<?= $dato["id_asignatura"]; ?>">
                      <input type="hidden" name="img" value="<?= $dato["portada_asignatura"]; ?>">
                      <input type="hidden" name="accion" value="EliminarAsignatura">
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot>
            <tr>
              <!-- <th style="width: 10px;">Nº</th> -->
              <th style="width: 10px;">Id</th>
              <!-- <th>Foto</th> -->
              <th>Nombre</th>
              <th>Area Academica</th>
              <th>Portada</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Insertar Asignatura -->
<div class="modal fade" id="formularioInsertarAsignaturaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <form method="POST" action="asignaturas" id="formularioInsertarAsignatura" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="InsertarAsignatura">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Insertar Asignatura</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputState">Nombre:</label>
              <input type="text" class="form-control" name="add_nombre" id="add_nombre" placeholder="Asignatura" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputState">Area Academica:</label>
              <select class="form-control" name="add_area" id="add_area">
                <?php foreach ($areasAcademicas as $areasAcademica) { ?>
                  <option value="<?= $areasAcademica["id_area"]; ?>"><?= $areasAcademica["nombre_area"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-row d-flex align-items-center">
            <div class="form-group col-md-6">
              <label for="exampleInputFile">Subir Portada</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="add_portada" name="add_portada" required onchange="previsualizarIMG(this, 'previsualizarImg')" lang="es">
                <label class="custom-file-label" for="customFile">Subir imagen</label>
              </div>
            </div>
            <div class="form-group col-md-6 align-content-center">
              <img id="previsualizarImg" src="#" alt="Vista previa de la imagen" style="display: none;" class="w-100 h-100 m-auto">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger btn-pill" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success btn-pill">Insertar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal Editar Asignatura -->
<div class="modal fade" id="formularioEditarAsignaturaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <form method="POST" action="asignaturas" id="formularioEditarAsignatura" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="EditarAsignatura">
    <input type="hidden" name="edit_id" id="edit_id" value="">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Editar Asignatura</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputState">Nombre:</label>
              <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" required>
            </div>
            <div class="form-group col-md-6">
              <label for="inputState">Area Academica:</label>
              <select class="form-control" name="edit_area" id="edit_area">
                <?php foreach ($areasAcademicas as $areasAcademica) { ?>
                  <option value="<?= $areasAcademica["id_area"]; ?>"><?= $areasAcademica["nombre_area"]; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-row d-flex align-items-center">
            <div class="form-group col-md-6">
              <label for="exampleInputFile">Editar Portada</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="edit_portada" name="edit_portada" onchange="previsualizarIMG(this, 'edit_previsualizarImg')" lang="es">
                <label class="custom-file-label" for="customFile">Editar Portada</label>
              </div>
            </div>
            <div class="form-group col-md-6 align-content-center">
              <img id="edit_previsualizarImg" src="#" alt="Vista previa de la imagen" style="display: none;" class="w-100 h-100 m-auto">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger btn-pill" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success btn-pill">Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Modal para mostrar la imagen en tamaño grande -->
<div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="imagenGrande" src="" style="width: 100%;">
      </div>
    </div>
  </div>
</div>