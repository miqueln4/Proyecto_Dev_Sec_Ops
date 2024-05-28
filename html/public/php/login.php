<?php
session_start();
include('database.php');
include('functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $functions = new functions();

    $hashedPassword = $functions->encrypt_password($password);

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        $tmp_user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($stmt->rowCount() == 1) {
            
            $_SESSION['user_id'] = $tmp_user['id'];

            header('Location: ../../posts.php');
            exit();
        } else {
            echo "Invalid username or password";
            exit();
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>