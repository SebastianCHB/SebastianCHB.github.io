<?php
include "./conexion.php";

if (isset($_POST['txtId']) && isset($_POST['txtNamee']) && isset($_POST['txtDesc']) && isset($_POST['txtPrice']) && isset($_POST['txtDuracion'])) {
    $id_paquete = $_POST['txtId']; // Recibe el id_paquete del formulario
    $nombre = $_POST['txtNamee'];
    $descripcion = $_POST['txtDesc'];
    $precio = $_POST['txtPrice'];
    $duracion = $_POST['txtDuracion'];
    
    // Verifica si se ha subido una nueva imagen
    if ($_FILES['txtImg']['name']) {
        $imagen = $_FILES['txtImg']['name'];  // El nombre de la imagen
        $target_dir = "uploads/";  // Ajusta esta ruta según tu estructura de directorios
        $target_file = $target_dir . basename($_FILES["txtImg"]["name"]);
        
        // Mover el archivo subido
        if (move_uploaded_file($_FILES["txtImg"]["tmp_name"], $target_file)) {
            // Si se ha subido correctamente la imagen
        } else {
            // Manejo de error si la imagen no se subió correctamente
            echo "Error al subir la imagen.";
        }
    } else {
        // Si no se sube una imagen, usar la imagen actual
        $imagen = $_POST['txtImg'];  // Asume que en este caso la imagen no se cambió
    }

    // Preparar y ejecutar la consulta SQL para actualizar el paquete
    $consulta = "UPDATE paquete_viaje SET 
                nombre_paquete = ?, 
                descripcion = ?, 
                precio = ?, 
                duracion = ?, 
                imagen = ? 
                WHERE id_paquete = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio, $duracion, $imagen, $id_paquete);

    if ($stmt->execute()) {
        // Redirigir a la página de éxito después de la actualización
        header("Location: ../payment.php?status=success");
    } else {
        // Si hay un error en la ejecución, mostrar un mensaje
        echo "Error al actualizar el paquete: " . $stmt->error;
    }

    // Cerrar la consulta
    $stmt->close();
    $conexion->close();
} else {
    echo "Faltan datos para actualizar el paquete.";
}
?>
    