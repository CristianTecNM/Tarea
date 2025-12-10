<?php
require_once "conexionLocal.php";

$nombre   = $_POST["nombre"] ?? '';
$apellido = $_POST["apellido"] ?? '';
$edad     = $_POST["edad"] ?? '';

if (empty($nombre) || empty($apellido) || empty($edad)) {
    die("Error: faltan datos obligatorios");
}

try {
    
    $conn_local->beginTransaction();

   
    $stmt = $conn_local->prepare("INSERT INTO tbl_alumno (vNombre, vApellido, iEdad) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $apellido, $edad]);

    
    $id_local = $conn_local->lastInsertId();

    
    $url = "http://10.20.3.226/cristian/recibir.php";
    $data = [
        'id'       => $id_local,
        'nombre'   => $nombre,
        'apellido' => $apellido,
        'edad'     => $edad
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    // Validar respuesta
    if ($error) {
        $conn_local->rollBack();
        die("Error al enviar al servidor: $error");
    }

    $res = json_decode($response, true);

    if ($res === null) {
        $conn_local->rollBack();
        die("Error: respuesta del servidor no válida. Respuesta: $response");
    }

    if ($res["status"] === "ok") {
        $conn_local->commit();
        echo "Registro insertado en local y servidor correctamente.<br>";
        echo "<a href='formulario.php'>Volver</a>";
    } else {
        $conn_local->rollBack();
        die("Error en servidor: " . ($res["mensaje"] ?? "desconocido"));
    }

} catch (Exception $e) {
    $conn_local->rollBack();
    die("Error local: " . $e->getMessage());
}
?>
