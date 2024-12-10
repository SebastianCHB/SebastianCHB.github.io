<?php
include './conexion.php'; // Conexión a la base de datos


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario
    $id = $_POST['txtIdd'];
    $name = $_POST['txtName'];
    $email = $_POST['txtEmail'];

    // Verifica si los datos están completos
    if (!empty($id) && !empty($name) && !empty($email)) {
        // Prepara la consulta de actualización
        $consulta = "UPDATE users SET nombre = ?, email = ? WHERE id_user = ?";
        
        // Usamos la sentencia preparada para evitar inyecciones SQL
        $stmt = $conexion->prepare($consulta);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
        
        // Vinculamos los parámetros
        $stmt->bind_param("ssi", $name, $email, $id);
        
        // Ejecutamos la consulta
        if ($stmt->execute()) {
            echo "Datos actualizados correctamente.";
            header("Location: ../users.php?status=updated"); // Redirige al usuario
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
        
        // Cierra la sentencia
        $stmt->close();
    } else {
        echo "Todos los campos son requeridos.";
    }
} else {
    echo "Método no permitido.";
}
?>

$conexion->close();
?>
