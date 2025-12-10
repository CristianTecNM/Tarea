<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumno</title>
</head>
<body>
    <h2>Registro de Alumno</h2>

    <form action="registrar.php" method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" required><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
