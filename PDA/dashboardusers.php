    <?php session_start();
        if(isset($_SESSION['userdata'])){
        $user=$_SESSION['userdata'];
        }else{
        header("Location: ./login.php");
        }
    include "./php/conexion.php";
    $sql="SELECT * FROM paquete_viaje";
    $res = $conexion->query($sql) or die($conexion->error);

// Si se envió el formulario de reserva
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['detalles'])) {
    $id_paquete = $_GET['id_paquete'];
    $tipo_pago = $_GET['tipo'];
    $detalles = $_GET['detalles'];

    // Insertar en la tabla de pagos
    $insert_sql = "INSERT INTO pago (id_paquete, tipo, detalles, fecha_registro)
                   VALUES ('$id_paquete', '$tipo_pago', '$detalles', NOW())";
    if ($conexion->query($insert_sql)) {
        // Redirigir al modal de confirmación de pago
$payment_id = $conexion->insert_id; // Obtener el ID del pago insertado
echo "<script>window.location.href = '?id_paquete=$id_paquete&tipo=$tipo_pago&detalles=$detalles#confirmModal$payment_id';</script>";

    } else {
        echo "Error al procesar el pago.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAQUETES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/routify.css">
</head>
<body>
    <div class="d-flex"> 
        <!-- Sidebar -->
        <?php include "../layouts/asideusers.php"?>
        <!-- End Sidebar -->

        <main class="flex-grow-1">
    <!-- Header -->
    <?php include "../layouts/headerusers.php"?>
    <!-- End Header -->

    <!-- Paquetes de Viaje -->
    <div class="row mx-4 px-4 my-4 g-3"> <!-- g-3 para reducir el espacio entre columnas -->
            <?php while ($paquete = mysqli_fetch_assoc($res)) { ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3"> <!-- Ajustar el tamaño de las columnas -->
                    <div class="card">
                        <img src="./img/travels/<?php echo $paquete['imagen']; ?>" class="card-img-top" alt="Imagen Paquete" >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $paquete['nombre_paquete']; ?></h5>
                            <p class="card-text"><?php echo $paquete['descripcion']; ?></p>
                            <p class="card-text">Precio: $<?php echo number_format($paquete['precio'], 2); ?></p>
                            <p class="card-text">Duración: <?php echo $paquete['duracion']; ?></p>
                            
                            
                            <!-- Botón de reserva que abre el modal -->
                            <button type="button" class="btn btn-primary btn-purple" data-bs-toggle="modal" data-bs-target="#reservaModal<?php echo $paquete['id_paquete']; ?>">
                                Reservar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal de reserva -->
                <div class="modal fade" id="reservaModal<?php echo $paquete['id_paquete']; ?>" tabindex="-1" aria-labelledby="reservaModalLabel<?php echo $paquete['id_paquete']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reservaModalLabel<?php echo $paquete['id_paquete']; ?>">Reserva de Paquete: <?php echo $paquete['nombre_paquete']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="GET">
                                    <input type="hidden" name="id_paquete" value="<?php echo $paquete['id_paquete']; ?>">
                                    
                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo de pago</label>
                                        <select class="form-select" id="tipo" name="tipo" required>
                                            <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="detalles" class="form-label">Detalles del Pago</label>
                                        <input type="text" class="form-control" id="detalles" name="detalles" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-purple">Reservar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</div>
</main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <style>
        /* Efecto de zoom y elevación al pasar el ratón sobre la tarjeta */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.01); /* Efecto zoom */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra para efecto de elevación */
        }

        /* Estilo para el botón morado */
        .btn-purple {
            background-color: #8e44ad; /* Color morado */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 25px; /* Bordes redondeados */
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-decoration: none; /* Eliminar subrayado */
            display: inline-block;
        }

        .btn-purple:hover {
            background-color: #8e44ad; /* Color más claro en hover */
            transform: translateY(-3px); /* Efecto de elevación en hover */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Sombra más pronunciada */
        }
    </style>
</html>
