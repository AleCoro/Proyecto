<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Usuarios</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="editar">Editar</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form role="form" action="" method="POST" enctype="multipart/form-data">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Editar usuario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <!-- nombre -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="<?= $usuario["nombre"]?>" required="">
                    <input type="hidden" name="nombreActual" value="<?= $usuario["nombre"]?>">
                </div>
                <!-- usuario -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
                    <input type="hidden" name="usuarioActual" value="<?= $_POST["editarUsuario"]?>">
                </div>
                <!-- password -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="text" class="form-control" name="editarPassword" placeholder="Escriba la nueva contraseña">
                    <input type="hidden" name="passwordActual" value="<?= $usuario["password"]?>">
                </div>
                <!-- perfil -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <input type="hidden" name="perfilActual" value="<?= $usuario["perfil"]?>">
                    <select class="form-control" name="editarPerfil">
                    <option value="" id="editarPerfil"></option>
                    <option value="Administrador">Administrador</option>
                    <option value="Especial">Especial</option>
                    <option value="Vendedor">Vendedor</option>
                    </select>
                </div>
                <!-- subir foto -->
                <div class="form-group">
                    <div class="panel">Subir foto</div>
                    <input type="hidden" name="fotoActual" value="<?= $usuario["foto"]?>">
                    <input type="file" class="nuevaFoto" name="editarFoto">
                    <p class="help-block">Peso máximo de la foto: 2Mb</p>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar usuario</button>
            </div>
            <?php
            if (isset($_POST["editarNombre"])) {
              $editarUsuario = new ControladorUsuarios();
              $editarUsuario->ctrEditarUsuario();
            }
            
         
            ?>
        </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
