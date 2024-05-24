<?php
include('database.php'); 
include('functions.php');
$functions = new functions();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y sanitizar los valores del formulario
    $username = htmlspecialchars(trim($_POST['username']));
    $name = htmlspecialchars(trim($_POST['name']));
    $dni = htmlspecialchars(trim($_POST['dni']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatPassword = htmlspecialchars(trim($_POST['repeat-password']));

    // Inicializar un array de errores
    $errors = [];

    // Validar DNI
    if (!$functions->check_dni($dni)) {
        $errors['dni'] = "DNI inválido";
    }

    // Validar fuerza de la contraseña
    if (!$functions->validatePassword($password)) {
        $errors['password'] = "La contraseña no cumple con los requisitos de seguridad";
    }

    // Validar que las contraseñas coincidan
    if ($password !== $repeatPassword) {
        $errors['repeat-password'] = "Las contraseñas no coinciden";
    }

    // Si hay errores, guardar en la sesión y redirigir
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../../register.html');
        exit();
    }

    // Convertir la contraseña a hash
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Preparar y ejecutar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO usuarios (username, name, dni, email, password) VALUES (:username, :name, :dni, :email, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "Error";
        }
        $_SESSION['user_id'] = $username;
        header('Location: ../../posts.php');
        exit();
    } catch (PDOException $e) {
        // Capturar errores
        error_log("Error al registrar el usuario: " . $e->getMessage());
        $_SESSION['error'] = "Ocurrió un error, por favor intente de nuevo más tarde.";
        header('Location: ../../register.html');
        exit();
    }
} else {
    echo "Método no permitido";
}
?>
