<?php
$server = "db";
$user = "root";
$password = "root_password";
$bd = "lamp_db";

try{
    $conn = new PDO("mysql:host=".$server.";dbname=".$bd,$user,$password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "Error de conexion " . $e->getMessage();
};

?>