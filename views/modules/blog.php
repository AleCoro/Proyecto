<?php
  $postsController = new PostsController();
  $posts = $postsController->ctrMostrarPosts("post");

  // var_dump($posts);

  if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
  } else {
    $pagina = 1;
  }

  $registrosxpagina=3;

  $postsPaginados = $postsController->ctrMostrarPaginacion("post", $pagina, $registrosxpagina);
  $total=Count($posts);
  $paginas=ceil($total/$registrosxpagina);





  include("views/partials/blogView.php");