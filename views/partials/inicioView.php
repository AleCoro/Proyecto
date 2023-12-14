    <!-- Header Start -->
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
      <div class="row align-items-center px-3">
        <div class="col-lg-6 text-center text-lg-left">
          <h4 class="text-white mb-4 mt-5 mt-lg-0">Academia colaborativa</h4>
          <h1 class="display-3 font-weight-bold text-white">
            Nuevo enfoque para la educación
          </h1>
          <p class="text-white mb-4">
            Descubre el poder de aprender juntos en nuestra innovadora academia colaborativa. Aquí, el conocimiento se fusiona con la creatividad, y cada mente es una fuente de inspiración. Únete a nuestra comunidad educativa donde el aprendizaje es más que una experiencia, es una colaboración que impulsa el éxito.
            <br>
            🚀 Explora, conecta y crea con nosotros. ¡Transformemos el aprendizaje en una aventura compartida!
          </p>
          <a href="about" class="btn btn-secondary mt-1 py-3 px-5">Leer mas</a>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
          <img class="img-fluid mt-2 mb-2 w-75 h-75" src="views/img/header.png" alt="" />
        </div>
      </div>
    </div>

    <!-- Header End -->

    <!-- Facilities Start -->
    <div class="container-fluid pt-5">
      <div class="container pb-3">
        <div class="row">
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Colaboración Ilimitada</h5>
                <p class="m-0">
                  Descubre la sinergia educativa en nuestra academia sin fronteras.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-048-paper-plane h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Educación Innovadora</h5>
                <p class="m-0">
                  Sumérgete en un mundo educativo innovador y vanguardista.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-030-crayons h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Mentores Apasionados</h5>
                <p class="m-0">
                  Únete a una comunidad con infinitos mentores listos para inspirarte.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-032-book h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Aprendizaje Emocionante</h5>
                <p class="m-0">
                  Haz del aprendizaje una experiencia emocionante con recursos multimedia.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-029-clock h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Flexibilidad Personalizada</h5>
                <p class="m-0">
                  Adaptamos el aprendizaje a tu estilo de vida con horarios flexibles.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 pb-1">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px">
              <i class="flaticon-028-kindergarten h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
                <h5>Éxito Colaborativo</h5>
                <p class="m-0">
                  Alcanza alturas inimaginables a través de nuestro espíritu de equipo.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Facilities Start -->

    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Clases populares</span>
          </p>
          <h1 class="mb-4">Descubre nuestras clases más demandadas</h1>
        </div>
        <div class="row">
          <?php foreach ($asignaturasPopulares as $asignaturaPopular) { ?>

            <div class="col-lg-4 mb-5">
              <div class="card border-0 bg-light shadow-sm pb-2">
                <img class="card-img-top mb-2"  src="<?= "admin/" . $asignaturaPopular["portada_asignatura"] ?>" alt="" />
                <div class="card-body text-center">
                  <h4><?= $asignaturaPopular["nombre_asignatura"] ?></h4>
                  <p class="card-text">
                    Justo ea diam stet diam ipsum no sit, ipsum vero et et diam
                    ipsum duo et no et, ipsum ipsum erat duo amet clita duo
                  </p>
                </div>
                <div class="card-footer bg-transparent py-4 px-5">
                  <div class="row border-bottom">
                    <div class="col-6 py-1 text-right border-right">
                      <strong>Nº de Reservas</strong>
                    </div>
                    <div class="col-6 py-1"><?= $asignaturaPopular["Reservas"] ?></div>
                  </div>
                  <div class="row border-bottom">
                    <div class="col-6 py-1 text-right border-right">
                      <strong>Profesores:</strong>
                    </div>
                    <div class="col-6 py-1"><?= $asignaturaPopular["ProfesoresImpartiendo"] ?></div>
                  </div>
                  <div class="row border-bottom">
                    <div class="col-6 py-1 text-right border-right">
                      <strong>Precio Medio</strong>
                    </div>
                    <div class="col-6 py-1"><?= $asignaturaPopular["PrecioMedio"] ?> €</div>
                  </div>
                </div>
                <form action="team" method="post" class="m-auto">
                  <input type="hidden" name="id_asignatura" value="<?= $asignaturaPopular["asignatura"]; ?>">
                  <button class="btn btn-primary px-4 mx-auto mb-4">¡Encuentra a tu profesor!</button>
                </form>

              </div>
            </div>

          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Class End -->

    <!-- Team Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Nuestros profesores</span>
          </p>
          <h1 class="mb-4">Mejores Valorados</h1>
        </div>
        <div class="row">
          <?php foreach ($profesores as $profesor) { ?>
            <div class="col-md-6 col-lg-3 text-center team mb-5">
              <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%">
                <img class="img-fluid w-100" src="<?= "admin/" . $profesor["foto"] ?>" alt="" />
                <div class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                  <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-twitter"></i></a>
                  <a class="btn btn-outline-light text-center mr-2 px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-facebook-f"></i></a>
                  <a class="btn btn-outline-light text-center px-0" style="width: 38px; height: 38px" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
              </div>
              <h4><?= $profesor["nombre"] . " " . $profesor["apellidos"]; ?></h4>
              <div class="valoracion justify-content-center" id="valoracion">
                <?php for ($i = 5; $i >= 1; $i--) { ?>
                  <span class="fa fa-star starShow <?= $i <= $profesor["ValoracionMedia"] ? 'active' : ''; ?>" data-value="<?= $i; ?>"></span>
                <?php } ?>
              </div>
            </div>

          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    <!-- <div class="container-fluid py-5">
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
    </div> -->
    <!-- Testimonial End -->

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Blog</span>
          </p>
          <h1 class="mb-4">Últimos artículos del blog</h1>
        </div>
        <div class="row pb-3">
          <?php foreach ($posts as $post) { ?>
            <div class="col-lg-4 mb-4">
              <div class="card border-0 shadow-sm mb-2">
                <img class="card-img-top mb-2" src="<?= "admin/" . $post["imagen"]; ?>" alt="" />
                <div class="card-body bg-light text-center p-4">
                  <h4 class=""><?= $post["titulo"]; ?></h4>
                  <div class="d-flex justify-content-center mb-3">
                    <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> <?= $post["NumComentarios"];?></small>
                  </div>
                  <p> <?= $post["descripcion"]; ?> </p>
                  <form action="postDetalle" method="post">
                    <input type="hidden" name="id_post" value="<?= $post["id_post"]; ?>">
                    <button type="submit" class="btn btn-primary px-4 mx-auto my-2">Leer Mas</button>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade show" id="seleccionPerfilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 30%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Selecciona tu rol</h5>
          </div>
          <div class="modal-body">
            <div class="nav-item dropdown">
              <form action="" method="post" id="formularioRoles">
                <select name="perfilSeleccionado" id="perfilSeleccionado" class="form-control" onchange="document.getElementById('formularioRoles').submit()">
                  <option value="" selected>Selecciona</option>
                  <?php foreach ($nombresRoles as $nombreRol) { ?>
                    <option value="<?= $nombreRol['id_rol']; ?>"><?= $nombreRol["nombre_rol"]; ?></option>
                  <?php } ?>
                </select>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>