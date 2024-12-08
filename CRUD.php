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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $preferencias = $_POST['preferencias'];
    $sqlInsert = "INSERT INTO usuarios (nombre, correo, fechaNacimiento, preferencias) VALUES ('$nombre', '$correo', '$fechaNacimiento', '$preferencias')";
    $conn->query($sqlInsert);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $preferencias = $_POST['preferencias'];
    $sqlUpdate = "UPDATE usuarios SET nombre='$nombre', correo='$correo', fechaNacimiento='$fechaNacimiento', preferencias='$preferencias' WHERE id=$id";
    $conn->query($sqlUpdate);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
    $conn->query($sqlDelete);
}

$sql = "SELECT id, nombre, correo, fechaNacimiento, preferencias FROM usuarios ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Fecha Nacimiento</th><th>Personaje Favorito</th><th>Acciones</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["correo"] . "</td>
                <td>" . $row["fechaNacimiento"] . "</td>
                <td>" . $row["preferencias"] . "</td>
                <td>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='hidden' name='action' value='delete'>
                        <button type='submit'>Eliminar</button>
                    </form>
                    <form method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='hidden' name='action' value='edit'>
                        <button type='submit'>Editar</button>
                    </form>
                </td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No hay registros.";
}

$conn->close();
?>
<br>
<h2>Agregar o Editar Usuario</h2>
<form method="POST">
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="id" id="edit-id">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="correo">Correo:</label>
    <input type="email" name="correo" id="correo" required>
    <label for="fechaNacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fechaNacimiento" id="fechaNacimiento" required>
    <label for="preferencias">Personaje Favorito:</label>
    <input type="text" name="preferencias" id="preferencias" required>
    <button type="submit">Guardar</button>
</form>

<a href="index.html" class="boton-regresar">Regresar a la página principal</a>
</div>
<script>
    document.querySelectorAll('form[action="edit"]').forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const row = e.target.closest('tr');
            document.getElementById('edit-id').value = row.querySelector('input[name="id"]').value;
            document.getElementById('nombre').value = row.children[1].innerText;
            document.getElementById('correo').value = row.children[2].innerText;
            document.getElementById('fechaNacimiento').value = row.children[3].innerText;
            document.getElementById('preferencias').value = row.children[4].innerText;
            document.querySelector('input[name="action"]').value = 'update';
        });
    });
</script>
</body>
</html>
