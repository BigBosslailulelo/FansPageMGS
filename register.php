<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cuenta</title>
    <link rel="stylesheet" href="Estilosphp.css">
</head>
<body>
<div class="contenedor">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fan_registry";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $fechaNacimiento = mysqli_real_escape_string($conn, $_POST['fechaNacimiento']);
    $preferencias = mysqli_real_escape_string($conn, $_POST['preferencias']);

    if (DateTime::createFromFormat('Y-m-d', $fechaNacimiento) !== false) {
        $sql = "INSERT INTO usuarios (nombre, correo, fechaNacimiento, preferencias)
                VALUES ('$nombre', '$correo', '$fechaNacimiento', '$preferencias')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Fecha de nacimiento no válida.";
    }

    $conn->close();
}
?>
<br>
<a href="index.html" class="boton-regresar">Regresar a la página principal</a>
</div>
</body>
</html>