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
    if (isset($_POST['deleteId']) && is_numeric($_POST['deleteId'])) {
        $id = (int) $_POST['deleteId'];

        $sql = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $sql->bind_param("i", $id);

        if ($sql->execute()) {
            echo "Usuario eliminado exitosamente";
        } else {
            echo "Error al eliminar usuario: " . $conn->error;
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