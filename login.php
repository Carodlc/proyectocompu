<?php
// Credenciales de usuario
$usuario_valido = "carolina";
$contrasena_valida = "carolina";

// Obtener datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['username'];
    $contrasena = $_POST['password'];

    // Verificar credenciales
    if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
        // Inicio de sesión exitoso, redirigir a index.html
        header("Location: index.html");
        exit();
    } else {
        // Credenciales incorrectas
        echo "<p style='color: red; text-align: center;'>Usuario o contraseña incorrectos.</p>";
    }
}
?>
