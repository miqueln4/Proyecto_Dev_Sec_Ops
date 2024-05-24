<?php
require_once './config.php';

// Get the posts from the database
$stmt = $conn->prepare('SELECT * FROM posts ORDER BY id DESC');
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the posts
echo '<h1>Latest Posts</h1>';
foreach ($posts as $post) {
    echo '<h2>' . htmlspecialchars($post['titulo']) . '</h2>';
    echo '<p>' . htmlspecialchars($post['contenido']) . '</p>';
    echo '<p><a href="view_post.php?id=' . $post['id'] . '">Read More</a></p>';
}