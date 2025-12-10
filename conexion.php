<?php
$servername = "127.0.0.1";
$username = "admin";
$password = "informatica";
$database = "db_Cristian";

try {
    // Conexión con PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
    // Habilitar excepciones para errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>

