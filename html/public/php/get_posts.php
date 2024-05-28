<?php

try {
    include 'database.php'; // Incluye tu archivo de conexión a la base de datos
    $stmt = $conn->prepare('SELECT noticias.id_noticia, noticias.titulo, noticias.descripcion, noticias.username, galeria.file_path 
                            FROM noticias 
                            LEFT JOIN galeria ON noticias.id_noticia = galeria.id_noticia');
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Error al obtener los posts: ' . $e->getMessage());
    $posts = [];
}
?>
