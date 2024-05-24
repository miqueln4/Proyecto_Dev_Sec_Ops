<?php
// Iniciar la sesión y verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.html");
    exit();
}

// Conectar a la base de datos
include('database.php');

try {
    // Obtener los datos del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}



// Obtener las imágenes del usuario
try {
    $stmt = $conn->prepare("SELECT * FROM galeria WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Perfil</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .user-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }
    .logout-button {
        position: fixed;
        bottom: 20px;
        left: 20px;
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../../posts.php">Sr. Navarro Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../../posts.php">Noticias</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.html">Log in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../register.php">Sign up</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="perfil.html">
                <img src="../../images/usuario_perfil.avif" alt="User" class="user-icon">
              </a>
            </li>
          </ul>
        </div>
    </nav>
  <div class="container">
    <h1 class="text-center my-4">Perfil de Usuario</h1>
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tus datos</h4>
          </div>
          <div class="card-body">
            <!-- Aquí se mostrarán los datos del usuario -->
            <p>Nombre de Usuario: <?php echo $user['username'];?></p>
            <p>Correo Electrónico: <?php echo $user['email'];?></p>
            <p>Nombre: <?php echo $user['name'];?></p>
            <p>DNI: <?php echo $user['dni'];?></p>
          </div>
        </div>
      </div>
    </div>

    <h2 class="text-center my-4">Galería</h2>
    <div class="row">
      <?php foreach ($images as $image): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="<?php echo $image['file_path']; ?>" class="card-img-top" alt="...">
            
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <div class="logout-button">
    <form method="post" action="logout.php">
      <button type="submit" class="btn btn-danger">Cerrar sesión</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
