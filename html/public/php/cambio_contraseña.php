<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.html");
    exit();
}

include('database.php');
include('functions.php'); 

$functions = new functions();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $functions->encrypt_password($_POST['old_password']);
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    $user_id = $_SESSION['user_id'];

    try {
        // Verificar la contraseña antigua
        $stmt = $conn->prepare("SELECT password FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $functions->password_verify($old_password, $user['password'])) {
            if ($new_password === $confirm_new_password) {
                // Verificar la fortaleza de la nueva contraseña
                if ($functions->encrypt_password($new_password)) {  // Usa la función para verificar la fortaleza de la contraseña
                    // Actualizar la contraseña
                    $new_password_hash = $functions->encrypt_password($new_password);
                    $stmt = $conn->prepare("UPDATE usuarios SET password = :password WHERE id = :id");
                    $stmt->bindParam(':password', $new_password_hash);
                    $stmt->bindParam(':id', $user_id);
                    $stmt->execute();
                    $success_message = "Contraseña actualizada exitosamente.";
                } else {
                    $error_message = "La nueva contraseña no cumple con los criterios de fortaleza.";
                }
            } else {
                $error_message = "Las contraseñas nuevas no coinciden.";
            }
        } else {
            $error_message = "La contraseña antigua es incorrecta.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cambiar Contraseña</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Cambiar Contraseña</h2>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form method="post" action="cambio_contraseña.php">
            <div class="form-group">
                <label for="old_password">Contraseña Antigua:</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirmar Nueva Contraseña:</label>
                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
    </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
