<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
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
        <a class="navbar-brand" href="#">Sr. Navarro Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">Noticias <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.html">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../register.html">Sign up</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="perfil.php">
                <img src="../../images/usuario_perfil.avif" alt="User" class="user-icon">
              </a>
            </li>
          </ul>
        </div>
    </nav>
  <div class="container">
    <h1 class="text-center my-4">Noticias</h1>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Añade una noticia</h4>
          </div>
          <div class="card-body">
            <form method="post" action="add_post.php" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" id="title" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="content">Descripcion</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
              </div>
              <div class="form-group">
                <label for="image">Sube una imagen (opcional)</label>
                <input type="file" name="image" id="image" class="form-control">
              </div>
              <button type="submit" name="add_post" class="btn btn-primary">Añadir post</button>
            </form>
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
