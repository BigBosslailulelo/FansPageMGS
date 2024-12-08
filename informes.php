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

$sql = "SELECT id, nombre, correo, fechaNacimiento, preferencias FROM usuarios ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>echaNacimiento</th><th>Personaje Favorito</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["correo"] . "</td><td>" . $row["fechaNacimiento"] . "</td><td>" . $row["preferencias"] . "</td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No hay registros.";
}

$conn->close();
?>
<br>
<a href="index.html" class="boton-regresar">Regresar a la página principal</a>
</div>
</body>
</html>