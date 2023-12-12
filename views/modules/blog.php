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

  foreach ($postsPaginados as &$postPaginados) {
    $comentarios = $postsController->ctrContarComentarios($postPaginados["id_post"]);
    $postPaginados["NumComentarios"] = $comentarios["totalComentarios"];
  }
  unset($postPaginados);





  include("views/partials/blogView.php");