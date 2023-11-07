<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
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
                            <img class="profile-user-img img-fluid img-circle" src="views/img/team-<?= rand(1, 4); ?>.jpg" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $usuario["nombre"] . " " . $usuario["apellidos"] ?></h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                                <li class="nav-item"><a class="nav-link active" href="#reservas" data-toggle="tab">Reservas</a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <?php if ($_SESSION["perfilSeleccionado"] == 2) { ?>
                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="calendario">
                                    <div id="calendarioMiPerfil"></div>
                                </div>
                                <!-- /.tab-pane -->
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
                                                <input type="time" class="form-control" name="hora" id="hora" min="06:00" max="21:00" required>
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
                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="reservas">

                                </div>
                            <?php } ?>
                            <div class="tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="views/img/team-<?= rand(1, 4); ?>.jpg" alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="views/img/team-<?= rand(1, 4); ?>.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="views/img/team-<?= rand(1, 4); ?>.jpg" alt="User Image">
                                        <span class="username">
                                            <a href="#">Adam Jones</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="views/img/team-<?= rand(1, 4); ?>.jpg alt=" Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="views/img/team-<?= rand(1, 4); ?>.jpg alt=" Photo">
                                                    <img class="img-fluid" src="views/img/team-<?= rand(1, 4); ?>.jpg alt=" Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="views/img/team-<?= rand(1, 4); ?>.jpg alt=" Photo">
                                                    <img class="img-fluid" src="views/img/team-<?= rand(1, 4); ?>.jpg alt=" Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="settings">
                                <form action="" method="post">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" value = "<?php if(isset($usuario["nombre"])){echo $usuario["nombre"];} ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value = "<?php if(isset($usuario["apellidos"])){echo $usuario["apellidos"];} ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Usuario</label>
                                            <input type="text" class="form-control" name="usuario" placeholder="Usuario" value = "<?php if(isset($usuario["usuario"])){echo $usuario["usuario"];} ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" value = "<?php if(isset($usuario["password"])){echo $usuario["password"];} ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Direccion</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="Direccion" value = "<?php if(isset($usuario["direccion"])){echo $usuario["direccion"];} ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Telefono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" value = "<?php if(isset($usuario["telefono"])){echo $usuario["telefono"];} ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" value = "<?php if(isset($usuario["email"])){echo $usuario["email"];} ?>" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Fecha Nacimiento</label>
                                            <input type="date" class="form-control" name="fecha" placeholder="Fecha Nacimiento" value = "<?php if(isset($usuario["fecha_nacimiento"])){echo $usuario["fecha_nacimiento"];} ?>" required >
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
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
        </div>
    </div>
</div>

