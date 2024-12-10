<?php
include './conexion.php'; // Conexión a la base de datos

$queryUpdateReservations = "UPDATE reservations SET id_user = NULL WHERE id_user = ?";
$stmt = $conexion->prepare($queryUpdateReservations);
$stmt->bind_param("i", $id);
$stmt->execute();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si el ID fue recibido
    if (isset($_POST['id_user']) && !empty($_POST['id_user'])) {
        $id = (int)$_POST['id_user']; // Convierte el ID a un entero

        // Prepara la consulta SQL
        $consulta = "DELETE FROM users WHERE id_user = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Registro eliminado correctamente.";
            header("Location: ../users.php?status=deleted");
        } else {
            echo "Error al eliminar el registro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "ID no recibido o vacío.";
    }
} else {
    echo "Método no permitido.";
}
$conexion->close();
?>
