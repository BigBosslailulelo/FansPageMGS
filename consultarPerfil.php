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
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consultarId = mysqli_real_escape_string($conn, $_POST['consultarId']);

    $sql = "SELECT * FROM usuarios WHERE id = $consultarId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h3>Perfil del Usuario</h3>";
            echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
            echo "<p><strong>Nombre:</strong> " . $row["nombre"] . "</p>";
            echo "<p><strong>Email:</strong> " . $row["correo"] . "</p>";
            echo "<p><strong>Personaje Favorito:</strong> " . $row["preferencias"] . "</p>";
        }
    } else {
        echo "<p>No se ha encontrado ningún perfil con ese ID.</p>";
    }
}

$conn->close();
?>
<br>
<a href="index.html" class="boton-regresar">Regresar a la página principal</a>
</div>
</body>
</html>
