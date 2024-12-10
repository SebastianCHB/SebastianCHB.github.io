<?php
include("./PDA/php/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el correo ya está registrado
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el correo ya existe, mostrar un mensaje
if ($result->num_rows > 0) {
    echo "<p style='color:red;'>Este correo electrónico ya está registrado. Por favor, usa otro.</p>";
} else {
    // Si el correo no existe, usamos la contraseña directamente sin cifrar
    if (!empty($password)) {
        $password_hash = $password; // Contraseña sin cifrar
    } else {
        // Si no hay contraseña, manejar el error o dejarla como null
        $password_hash = null;
    }
}

        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO users (nombre, email, password, rol) VALUES (?, ?, ?, 2)";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $password_hash);

        if ($stmt->execute()) {
            // Si la inserción fue exitosa, redirigir al login
            header("Location: login.php");
            exit();
        } else {
            // Si ocurre un error al insertar
            echo "<p style='color:red;'>Error al registrar el usuario. Intenta nuevamente.</p>";
        }

        // Cerrar la conexión
        $stmt->close();
    }

    // Cerrar la conexión
    $conexion->close();
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/Signupstyles.css">
    <link rel="stylesheet" href="./css/mediaquery.css">
</head>
<body>
    <div class="container">
        <div class="image-section2">
            <div class="image-text">Find your dreams come true</div>
        </div>
        <div class="form-section">
            <h1 id="main-text">Crear una Cuenta</h1>
            <h2 id="subtext">¿Ya tienes una cuenta? <a href="./login.php">Iniciar sesión</a></h2>
     <ul>
     <form method="POST" action="signup.php">
    <ul><input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
    <ul><input type="email" name="email" id="email" placeholder="Tu correo electrónico" required>
    
    <ul><input type="password" name="password" id="password" placeholder="Tu contraseña" required>
    <ul><button type="submit" id="btnregister">Registrarse</button>
</ul>   
</form>
    <script src="js/LandingPScripts.js"></script>
</body>
</html>
