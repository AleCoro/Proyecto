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
                        <li class="breadcrumb-item"><a href="#">Blog</a></li>
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
                <button class="btn btn-primary" data-toggle="modal" data-target="#formularioCrearPostModal">Añadir Post</button>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px;">Nº</th> -->
                            <th style="width: 10px;">Id</th>
                            <th>Tiitulo</th>
                            <th>Descripcion</th>
                            <th>Contenido</th>
                            <th>Imagen</th>
                            <th>Fecha Publicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post) { ?>
                            <tr>
                                <!-- <td></td> -->
                                <td><?= $post["id_post"]; ?></td>
                                <td><?= $post["titulo"]; ?></td>
                                <td><?= $post["descripcion"]; ?></td>
                                <td><?= $post["contenido"]; ?></td>
                                <td class="text-center">
                                    <img id="imagen-pequena" style="width: 80px; height: 60px;" src="<?= $post["imagen"]; ?>" onclick="mostrarIMG(this)">
                                    <!-- <a id="single_image" href="<?= $post["imagen"]; ?>"><img style="width: 80px; height: 60px;" src="<?= $post["imagen"]; ?>" alt="" /></a> -->
                                </td>
                                <td><?= $post["fecha_publicacion"]; ?></td>
                                <td>
                                    <div class="form-group d-flex">
                                        <button type="button" class="btn btn-warning mr-1" onclick='editarPost(<?= json_encode($post); ?>)'>
                                            <i class="fas fa-user-edit"></i>
                                        </button>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_post" value="<?= $post["id_post"]; ?>">
                                            <input type="hidden" name="img" value="<?= $post["imagen"]; ?>">
                                            <input type="hidden" name="accion" value="EliminarPost">
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
                            <th>Tiitulo</th>
                            <th>Descripcion</th>
                            <th>Contenido</th>
                            <th>Imagen</th>
                            <th>Fecha Publicación</th>
                            <!-- <th>Ultimo acceso</th> -->
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
</div>

<!-- Modal Crear Post -->
<div class="modal fade" id="formularioCrearPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <form method="POST" action="blog" id="formularioCrearPost" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="CrearPost">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Crear Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputState">Titulo:</label>
                            <input type="text" class="form-control" name="add_titulo" id="add_titulo" required>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="inputState">Descripcion:</label>
                            <input type="text" class="form-control" name="add_descripcion" id="add_descripcion" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">Contenido:</label>
                            <textarea id="editor1" maxlength="500" name="add_contenido"></textarea>
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
                    <button type="submit" class="btn btn-success btn-pill">Crear</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal Editar Post -->
<div class="modal fade" id="formularioEditarPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <form method="POST" action="blog" id="formularioEditarPost" enctype="multipart/form-data">
        <input type="hidden" name="accion" value="EditarPost">
        <input type="hidden" name="edit_id" id="edit_id" >
        <input type="hidden" name="img_old" id="img_old" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Editar Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputState">Titulo:</label>
                            <input type="text" class="form-control" name="edit_titulo" id="edit_titulo" required>
                        </div>
                        <div class="form-group col-md-9">
                            <label for="inputState">Descripcion:</label>
                            <input type="text" class="form-control" name="edit_descripcion" id="edit_descripcion" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">Contenido:</label>
                            <textarea id="editor2" maxlength="500" name="edit_contenido"></textarea>
                        </div>
                    </div>
                    <div class="form-row d-flex align-items-center">
                        <div class="form-group col-md-6">
                            <label for="exampleInputFile">Subir Portada</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_portada" name="edit_portada" onchange="previsualizarIMG(this, 'edit_previsualizarImg')" lang="es">
                                <label class="custom-file-label" for="customFile">Subir imagen</label>
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

<script>
    CargarEditor();
</script>