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
            <li class="breadcrumb-item"><a href="#">Areas Academicas</a></li>
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
        <button class="btn btn-primary" data-toggle="modal" data-target="#formularioInsertarAreaModal">Añadir Area Academica</button>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <!-- <th style="width: 10px;">Nº</th> -->
              <th style="width: 10px;">Id</th>
              <!-- <th>Foto</th> -->
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Portada</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datosAreasAcademicas as $dato) { ?>
              <tr>
                <td><?= $dato["id_area"]; ?></td>
                <td><?= $dato["nombre_area"]; ?></td>
                <td><?= $dato["descripcion_area"]; ?></td>
                <td class="text-center">
                  <img id="imagen-pequena" style="width: 80px; height: 60px;" src="<?= $dato["portada_area"]; ?>" onclick="mostrarIMG(this)">
                </td>
                <td>
                  <div class="form-group d-flex">
                    <button type="button" class="btn btn-warning mr-1" onclick='editarArea(<?= json_encode($dato); ?>)'>
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <form action="" method="post">
                      <input type="hidden" name="id_area" value="<?= $dato["id_area"]; ?>">
                      <input type="hidden" name="img" value="<?= $dato["portada_area"]; ?>">
                      <input type="hidden" name="accion" value="EliminarArea">
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
              <th>Descripcion</th>
              <th>Portada</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Insertar Area -->
<div class="modal fade" id="formularioInsertarAreaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <form method="POST" action="areasAcademicas" id="formularioInsertarArea" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="InsertarArea">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Insertar Area Academica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputState">Nombre:</label>
              <input type="text" class="form-control" name="add_nombre" id="add_nombre" required>
            </div>
            <div class="form-group col-md-8">
              <label for="inputState">Descripcion:</label>
              <textarea class="form-control" name="add_descripcion" id="add_descripcion" maxlength="300" rows="3"></textarea>
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

<!-- Modal Editar Area -->
<div class="modal fade" id="formularioEditarAreaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <form method="POST" action="areasAcademicas" id="formularioEditarArea" enctype="multipart/form-data">
    <input type="hidden" name="accion" value="EditarArea">
    <input type="hidden" name="edit_id" id="edit_id" value="">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalFormTitle">Editar Area Academica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputState">Nombre:</label>
              <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" required>
            </div>
            <div class="form-group col-md-8">
              <label for="inputState">Descripcion:</label>
              <textarea class="form-control" name="edit_descripcion" id="edit_descripcion" maxlength="300" rows="3"></textarea>
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