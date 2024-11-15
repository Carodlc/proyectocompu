<?php
// Credenciales de la base de datos
$hostname = "bdserver.mysql.database.azure.com";
$username = "adminbd";
$password = "Itscaro2022!"; // Cambia a tu contraseña
$dbname = "formulario"; // Nombre de tu base de datos
$port = 3306;

// Conectar a la base de datos
$conexion = new mysqli($hostname, $username, $password, $dbname, $port);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    $sql = "INSERT INTO datos_formulario (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";
    if ($conexion->query($sql) === TRUE) {
        echo "<p>Datos guardados exitosamente.</p>";
    } else {
        echo "<p>Error al guardar: " . $conexion->error . "</p>";
    }
}

// Consultar todos los registros
$sql = "SELECT * FROM datos_formulario ORDER BY fecha DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }
        h1 {
            text-align: center;
        }
        .results {
            margin-top: 2rem;
        }
        .record {
            background: #f9f9f9;
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Registros Capturados</h1>
    <div class="results">
        <?php
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                echo "<div class='record'>";
                echo "<p><strong>Nombre:</strong> " . $row['nombre'] . "</p>";
                echo "<p><strong>Correo:</strong> " . $row['correo'] . "</p>";
                echo "<p><strong>Mensaje:</strong> " . $row['mensaje'] . "</p>";
                echo "<p><strong>Fecha:</strong> " . $row['fecha'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay registros aún.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
// Cerrar conexión
$conexion->close();
?>
