<?php
require_once "conexion.php";

$nombre = $_POST["nombre"] ?? '';
$apellido = $_POST["apellido"] ?? '';
$edad = $_POST["edad"] ?? '';

if (empty($nombre) || empty($apellido) || empty($edad)) {
    die("Por favor, completa todos los campos.");
}

try {
   
    $sql_insert = "INSERT INTO  tbl_alumno (vNombre, vApellido, iEdad) VALUES (:nombre, :apellido, :edad)";

   
    $stmt = $conn->prepare($sql_insert);

 
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);

   
    if ($stmt->execute()) {
        echo "✅ Datos guardados correctamente.<br>";
        echo "Nombre: $nombre<br>";
        echo "Apellido: $apellido<br>";
        echo "Edad: $edad";
    } else {
        echo "❌ Error al guardar los datos.";
    }

} catch (PDOException $e) {
    echo "❌ Error al guardar: " . $e->getMessage();
}


$conn = null;
?>
