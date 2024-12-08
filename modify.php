<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Datos de Usuario</title>
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
    if (isset($_POST['modifyId']) && is_numeric($_POST['modifyId'])) {
        $id = (int) $_POST['modifyId'];
        $nuevo_nombre = $_POST['newNombre'];
        $nuevo_correo = $_POST['newCorreo'];
        $nuevo_personaje = $_POST['newPreferencias'];

        $sql = $conn->prepare("UPDATE usuarios SET nombre = ?, correo = ?, personaje_favorito = ? WHERE id = ?");
        $sql->bind_param("sssi", $nuevo_nombre, $nuevo_correo, $nuevo_personaje, $id);

        if ($sql->execute()) {
            echo "Usuario modificado exitosamente";
        } else {
            echo "Error al modificar usuario: " . $conn->error;
        }

        $sql->close();
    } else {
        echo "ID de usuario inválido o no proporcionado";
    }

    $conn->close();
}
?>
<br>
<a href="index.html" class="boton-regresar">Regresar a la página principal</a>
</div>
</body>
</html>
