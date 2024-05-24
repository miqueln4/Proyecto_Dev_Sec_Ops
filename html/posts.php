<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Posts</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .user-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="posts.php">Sr. Navarro Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="posts.php">Noticias <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.html">Sign up</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="public/php/perfil.php">
            <img src="images/usuario_perfil.avif" alt="User" class="user-icon">
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1 class="text-center my-4">Posts</h1>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Posts</h4>
          </div>
          <div class="card-body">
            <?php
            try {
              include 'public/php/get_posts.php';

              if (!empty($posts)) {
                foreach ($posts as $post) {
                  // Escapar todas las salidas para prevenir XSS
                  echo '<div class="post">';
                  echo '<h5>' . htmlspecialchars($post['titulo']) . '</h5>';
                  echo '<p>' . nl2br(htmlspecialchars($post['descripcion'])) . '</p>';
                  
                  
                  // Obtener la imagen asociada a la noticia
                  $file_path = '';
                  if (!empty($post['file_path'])) {
                    $file_path = htmlspecialchars($post['file_path']);
                    echo '<img src="' . $file_path . '" alt="Imagen de la noticia" class="img-fluid">';
                    
                  }
                  
                  echo '<p><small>Posted by ' . htmlspecialchars($post['username']) . '</small></p>';
                  echo '<hr>';
                  echo '</div>';
                }
              } else {
                echo '<p>No hay posts disponibles.</p>';
              }
            } catch (Exception $e) {
              echo '<p>Error al cargar los posts.</p>';
              error_log('Error al cargar los posts: ' . $e->getMessage());
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Añadir post</h4>
          </div>
          <div class="card-body">
            <?php if (isset($_SESSION['user_id'])): ?>
              <a href="public/php/dashboard.php" class="btn btn-primary">Añadir post</a>
            <?php else: ?>
              <a href="index.html" class="btn btn-primary">Log in</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
