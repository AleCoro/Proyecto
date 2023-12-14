<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h3 class="display-3 font-weight-bold text-white"><?= $usuario["nombre"] . " " . $usuario["apellidos"] ?></h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="inicio">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0"><?= $usuario["nombre"] . " " . $usuario["apellidos"] ?></p>
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
                            <img class="profile-user-img img-fluid img-circle" src="<?= "admin/" . $_SESSION["foto"] ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $usuario["nombre"] . " " . $usuario["apellidos"] ?></h3>

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
                            <?= (isset($asignaturasImpartidas["todasAsignaturas"])) ? $asignaturasImpartidas["todasAsignaturas"] : "Aun no ha impartido clases"; ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted"><?= $usuario["direccion"]; ?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Temas</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger"><?= (isset($asignaturasImpartidas["todosTemas"])) ? $asignaturasImpartidas["todosTemas"] : "Aun no ha impartido clases"; ?></span>
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
                            <?php if ($_SESSION["perfilSeleccionado"] == 2) { ?>
                                <li class="nav-item"><a class="nav-link active" href="#calendario" data-toggle="tab">Disponibilidad</a></li>
                                <li class="nav-item"><a class="nav-link" href="#impartir" data-toggle="tab">Impartir</a></li>
                            <?php } else { ?>
                                <li class="nav-item"><a class="nav-link active" href="#proximasClases" data-toggle="tab">Proximas Clases</a></li>
                                <li class="nav-item"><a class="nav-link" href="#clasesFinalizadas" data-toggle="tab">Clases Finalizadas</a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <?php if ($_SESSION["perfilSeleccionado"] == 2) { ?>
                                <!-- CALENDARIO -->
                                <div class="tab-pane active" id="calendario">
                                    <div id="calendarioMiPerfil"></div>
                                </div>
                                <!-- IMPARTIR -->
                                <div class="tab-pane" id="impartir">
                                    <form action="" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Selecciona el area academica</label>
                                                <select name="areaAcademica" id="areaAcademica" class="form-control" onchange="cargarAsignaturas()" required>
                                                    <option value="" selected>Selecciona</option>
                                                    <?php foreach ($areasAcademicas as $areaAcademica) { ?>
                                                        <option value="<?= $areaAcademica["id_area"] ?>"><?= $areaAcademica["nombre_area"] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Selecciona la asignatura</label>
                                                <select name="asignaturas" id="asignaturas" class="form-control" required>
                                                    <option value="" selected>Selecciona</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Fecha</label>
                                                <input type="date" class="form-control" name="fecha" id="fecha" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Hora</label>
                                                <input type="time" class="form-control" name="hora" id="hora" min="06:00" max="21:00" onblur="validarHora(this)" required>
                                                <span class="text-red" id="error"></span>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Precio/hora</label>
                                                <input type="number" class="form-control" name="precio" placeholder="Precio" min="0" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="impartir" value="impartir">
                                        <button type="submit" class="btn btn-primary">Publicar</button>
                                    </form>
                                </div>
                            <?php } ?>
                            <?php if ($_SESSION["perfilSeleccionado"] == 3) { ?>
                                <!-- PROXIMAS CLASES -->
                                <div class="tab-pane active" id="proximasClases">
                                    <div class="row">
                                        <?php foreach ($proximasClases as $proximaClase) { ?>
                                            <div class="col-md-6 mb-3">
                                                <div class="card" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-5">
                                                            <img src="<?= "admin/" . $proximaClase["foto"] ?>" class="img-fluid rounded-start w-100 h-100" alt="...">
                                                        </div>
                                                        <div class="col-md-7 d-flex flex-column">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?= $proximaClase["nombre"] . " " . $proximaClase["apellidos"] ?></h5>
                                                                <p class="card-text">Clase: <?= $proximaClase["nombre_asignatura"]; ?></p>
                                                                <p class="card-text">
                                                                    <small class="text-muted">
                                                                        <b>Fecha:</b> <?= $reservasController->formatearFecha($proximaClase["fecha_clase"]); ?>
                                                                        <b class="ml-2">Precio:</b> <?= $proximaClase["pagado"] ?> €
                                                                    </small>
                                                                </p>
                                                                <form action="" name="formularioValorar" method="post" class="mt-auto d-flex">
                                                                    <input type="hidden" name="accion" value="feedback">
                                                                    <!-- <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-sm btn-primary">Valorar Clase</button>
                                                                    </div> -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (count($proximasClases) < 1) { ?>
                                            <h3 class="ml-2">No tienes clases pendientes.</h3>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- CLASES FINALIZADAS -->
                                <div class="tab-pane" id="clasesFinalizadas">
                                    <div class="row">
                                        <?php foreach ($clasesFinalizadas as $claseFinalizada) { ?>
                                            <div class="col-md-6 mb-3">
                                                <div class="card" style="max-width: 540px;">
                                                    <div class="row g-0">
                                                        <div class="col-md-5">
                                                            <img src="<?= "admin/" . $claseFinalizada["foto"] ?>" class="img-fluid rounded-start w-100 h-100" alt="...">
                                                        </div>
                                                        <div class="col-md-7 d-flex flex-column">
                                                            <div class="card-body">
                                                                <h5 class="card-title"><?= $claseFinalizada["nombre"] . " " . $claseFinalizada["apellidos"] ?></h5>
                                                                <p class="card-text">Clase: <?= $claseFinalizada["nombre_asignatura"]; ?></p>
                                                                <p class="card-text">
                                                                    <small class="text-muted">
                                                                        <b>Fecha:</b> <?= $reservasController->formatearFecha($claseFinalizada["fecha_clase"]); ?>
                                                                        <b class="ml-2">Precio:</b> <?= $claseFinalizada["pagado"] ?> €
                                                                    </small>
                                                                </p>
                                                                <form action="" name="formularioValorar" method="post" class="mt-auto d-flex">
                                                                    <input type="hidden" name="accion" value="feedback">
                                                                    <!-- <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-sm btn-primary">Valorar Clase</button>
                                                                    </div> -->
                                                                </form>
                                                                <?php if ($claseFinalizada["valoracion"] == 0) { ?>
                                                                    <div class="valoracion" id="valoracion">
                                                                        <?php for ($i = 5; $i >= 1; $i--) { ?>
                                                                            <span class="fa fa-star star <?= $i <= $claseFinalizada["valoracion"] ? 'active' : ''; ?>" data-value="<?= $i; ?>" id_reserva="<?= $claseFinalizada["id_reserva"]; ?>" onclick="guardarValoracion(this)"></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="valoracion justify-content-left" id="valoracion">
                                                                        <?php for ($i = 5; $i >= 1; $i--) { ?>
                                                                            <span class="fa fa-star starShow <?= $i <= $claseFinalizada["valoracion"] ? 'active' : ''; ?>" data-value="<?= $i; ?>"></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (count($clasesFinalizadas) < 1) { ?>
                                            <h3 class="ml-2">Aun no has finalizado ninguna clase.</h3>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- AJUSTES -->
                            <div class="tab-pane" id="settings">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if (isset($usuario["nombre"])) {
                                                                                                                                    echo $usuario["nombre"];
                                                                                                                                } ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php if (isset($usuario["apellidos"])) {
                                                                                                                                        echo $usuario["apellidos"];
                                                                                                                                    } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Usuario</label>
                                            <input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if (isset($usuario["usuario"])) {
                                                                                                                                    echo $usuario["usuario"];
                                                                                                                                } ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php if (isset($usuario["password"])) {
                                                                                                                                            echo $usuario["password"];
                                                                                                                                        } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Direccion</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="Direccion" value="<?php if (isset($usuario["direccion"])) {
                                                                                                                                        echo $usuario["direccion"];
                                                                                                                                    } ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value="<?php if (isset($usuario["telefono"])) {
                                                                                                                                                    echo $usuario["telefono"];
                                                                                                                                                } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($usuario["email"])) {
                                                                                                                                    echo $usuario["email"];
                                                                                                                                } ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha Nacimiento</label>
                                            <input type="date" class="form-control" name="fecha" placeholder="Fecha Nacimiento" value="<?php if (isset($usuario["fecha_nacimiento"])) {
                                                                                                                                            echo $usuario["fecha_nacimiento"];
                                                                                                                                        } ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row d-flex align-items-center">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputFile">Subir Foto</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previsualizarIMG(this, 'previsualizarImg')">
                                                <label class="custom-file-label" for="customFile">Sube tu foto</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 align-content-center">
                                            <img id="previsualizarImg" src="<?= "admin/" . $_SESSION["foto"] ?>" alt="Vista previa de la imagen" class="w-25 h-25 ml-5 rounded-circle">
                                        </div>
                                    </div>
                                    <div class=" d-flex justify-content-center ">
                                        <input type="hidden" name="id_usuario" value="<?= $usuario["id_usuario"]; ?>">
                                        <input type="hidden" name="accion" value="editarPerfil">
                                        <button type="submit" class="btn btn-primary px-5">Editar</button>
                                    </div>
                                </form>
                                <?php if (count($usuarioRoles) < 2) { ?>
                                    <hr>
                                    <br>
                                    <form action="" method="post">
                                        <h3 class="text-center">Roles en de la aplicación</h3>
                                        <?php if (!in_array(2, $usuarioRoles)) { ?>
                                            <p>¿Quieres empezar a compartir tus conocimientos? </p><button class="btn btn-link" type="submit" name="addRol" value="2">Si, quiero ser profesor.</button>
                                        <?php } ?>

                                        <?php if (!in_array(3, $usuarioRoles)) { ?>
                                            <p>¿Quieres empezar a aprender? </p><button class="btn btn-link" type="submit" name="addRol" value="3">Si, quiero ser alumno.</button>
                                        <?php } ?>

                                    </form>
                                <?php } ?>

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
    cargarCalendarioMiPerfil(<?= $usuario["id_usuario"]; ?>);
</script>

<!-- Modal -->
<div class="modal fade" id="modaleditarClase" tabindex="-1" role="dialog" aria-labelledby="nombreAsignatura" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nombreAsignatura" name="nombreAsignatura">Título del Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body" id="descripcion">
                    <p>Contenido del modal. Puedes agregar texto, imágenes u otros elementos aquí.</p>
                </div>
                <div class="form-row p-2">
                    <div class="form-group col-md-6">
                        <label>Fecha</label>
                        <input type="date" class="form-control" name="edit_fecha" id="edit_fecha" min="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Hora</label>
                        <input type="time" class="form-control" name="edit_hora" id="edit_hora" min="06:00" max="21:00" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Precio/hora</label>
                        <input type="number" class="form-control" name="edit_precio" id="edit_precio" placeholder="Precio" min="0" required>
                    </div>
                    <input type="hidden" name="edit_id" id="edit_id" value="">
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="accion" value="editarClase">
                    <button type="submit" class="btn btn-warning">Editar</button>
            </form>
            <form action="" method="post">
                <input type="hidden" name="accion" value="eliminarClase">
                <input type="hidden" name="delete_id" id="delete_id" value="">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>