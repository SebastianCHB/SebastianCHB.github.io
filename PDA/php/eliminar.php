<?php
include './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_paquete']) && !empty($_POST['id_paquete'])) {
        $id_paquete = (int)$_POST['id_paquete'];

        // Paso 1: Eliminar reservas asociadas (si es necesario)
        $queryDeleteReservations = "DELETE FROM reservations WHERE id_paquete = ?";
        $stmt = $conexion->prepare($queryDeleteReservations);
        $stmt->bind_param("i", $id_paquete);
        $stmt->execute();

        // Paso 2: Eliminar el paquete
        $queryDeletePaquete = "DELETE FROM paquete_viaje WHERE id_paquete = ?";
        $stmt = $conexion->prepare($queryDeletePaquete);
        $stmt->bind_param("i", $id_paquete);

        if ($stmt->execute()) {
            header("Location: ../payment.php?status=deleted");
        } else {
            echo "Error al eliminar el paquete: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID no recibido.";
    }
} else {
    echo "Método no permitido.";
}
$conexion->close();
?>
