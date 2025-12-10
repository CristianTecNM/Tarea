<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_cristian";

try {
    // Conexión con PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
    // Habilitar excepciones para errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}
?>