<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.html');
    exit();
}

// Incluir el archivo de funciones
include('functions.php');
$func = new functions();

// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los valores del formulario
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // Incluir el archivo de conexión a la base de datos
    include('database.php');

    // Validar y procesar la imagen
    $imagePath = '';
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'avi', 'mov'];
    $allowed_magic_numbers = [
        'jpg' => ['ffd8ffe0', 'ffd8ffe1', 'ffd8ffe2'],
        'jpeg' => ['ffd8ffe0', 'ffd8ffe1', 'ffd8ffe2'],
        'png' => ['89504e47'],
        'gif' => ['47494638'],
        'webp' => ['52494646'],
        'mp4' => ['00000018', '00000020'],
        'avi' => ['52494646'],
        'mov' => ['00000014', '00000018', '0000001c']
    ];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!$func->upload_file($_FILES['image'], $allowed_extensions, $allowed_magic_numbers)) {
            $_SESSION['error'] = 'Archivo no permitido.';
            header('Location: dashboard.php');
            exit();
        } else {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $imagePath = '../../images/' . md5(time() . $fileName) . '.' . $fileExtension;
            move_uploaded_file($fileTmpPath, $imagePath);
        }
    }

    try {
        // Preparar y ejecutar la consulta SQL para insertar la noticia
        $stmt = $conn->prepare("SELECT username FROM usuarios WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $tmp_user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $tmp_user['username'];

        $stmt = $conn->prepare("INSERT INTO noticias (username, descripcion, titulo, fecha) VALUES (:username, :descripcion, :titulo, NOW())");
        $stmt->bindParam(':username', $user);
        $stmt->bindParam(':descripcion', $content);
        $stmt->bindParam(':titulo', $title);
        $stmt->execute();
        $last_id = $conn->lastInsertId();

        // Si hay una imagen, guardarla en la tabla galeria
        if (!empty($imagePath)) {
            $stmt = $conn->prepare("INSERT INTO galeria (user_id, file_path, file_type, id_noticia) VALUES (?, ?, ?, ?)");
            $mime = mime_content_type($imagePath);
            $stmt->execute([$user_id, $imagePath, $mime, $last_id]);
        }

        // Redirigir a posts.php después de agregar la noticia
        header('Location: ../../posts.php');
        exit();
    } catch (PDOException $e) {
        // Manejar errores
        echo "Error al agregar la noticia: " . $e->getMessage();
    }
} else {
    // Si no se envió el formulario, redirigir a dashboard.php
    header('Location: dashboard.php');
    exit();
}
?>
