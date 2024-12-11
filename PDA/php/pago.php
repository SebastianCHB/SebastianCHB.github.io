<?php 
session_start();

if (!isset($_SESSION['userdata'])) {
    // Redirige al login si la sesión no está activa
    header("Location: login.php");
    exit();
}

include "conexion.php";

// Obtener datos del formulario
$id_paquete = $_POST['id_paquete'];
$id_user = $_POST['id_user'];
$tipo = "Pago del paquete"; // Puedes cambiar esto según la lógica de tu sistema
$detalles = "Pago por el paquete"; // Detalles adicionales
$fecha_registro = date("Y-m-d");

// Insertar datos de pago en la base de datos
$sql = "INSERT INTO pago (tipo, detalles, fecha_registro, id_paquete, id_user) 
        VALUES ('$tipo', '$detalles', '$fecha_registro', '$id_paquete', '$id_user')";

if ($conexion->query($sql) === TRUE) {
    // Redirigir a la página de pago o mostrar un mensaje de éxito
    echo "<script>
            alert('Pago registrado correctamente.');
            window.location.href = 'confirmacion_pago.php'; // Página de confirmación o de pago real
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}
?>
