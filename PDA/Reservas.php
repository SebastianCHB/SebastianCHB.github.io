<?php session_start();
    if(isset($_SESSION['userdata'])){
      $user=$_SESSION['userdata'];
    }else{
      header("Location: ./login.php");
    }
    // Desactivar la caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
include "./php/conexion.php";

$sql="SELECT 
    reservations.id_reserva,
    reservations.fecha_ida,
    reservations.fecha_regreso,
    reservations.id_user,
    reservations.id_paquete
FROM 
    reservations
INNER JOIN 
    users ON reservations.id_user = users.id_user
INNER JOIN 
    paquete_viaje ON reservations.id_paquete = paquete_viaje.id_paquete;";


$res = $conexion->query($sql) or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ROUTIFY ADMINISTRATION PANEL</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/routify.css">
</head>

<body>
  <div class="d-flex"> 
    <!--sidebbar-->
    <?php include "../layouts/aside.php"?>
    <!--end sidebbar-->
    <main class="flex-grow-1">
        <!--header-->
        <?php include "../layouts/header.php"?>
      <!--end hedear-->
      <!--Title section-->
      <div class="mx-4 d-flex justify-content-between" style="padding-top: 40px;">
        <h1 class="h4">Reservations</h1>
        <div>
          <button class="btnrft btn-dark btnrtf" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
        </div>
      </div>
      <!--end Title section-->
      <section class="mt-4 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID_Reserva</th>
              <th scope="col">FECHA_IDA</th>
              <th scope="col">FECHA_REGRESO</th>
              <th scope="col">ID_USUARIO</th>
              <th scope="col">ID_PAQUETE</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <!--REGISTROS-->
            <?php 
            while($fila=mysqli_fetch_array($res)){
            ?>
            <tr>
              <td><?php echo $fila['id_reserva']?></td>
              <td><?php echo $fila['fecha_ida']?></td>
              <td><?php echo $fila['fecha_regreso']?></td>
              <td><?php echo $fila['id_user']?></td>
              <td><?php echo $fila['id_paquete']?></td>
              <td class="text-end">
                <button class="btn btn-outline-danger btn-sm btndeletereserva">
                  <i class="bi bi-trash2"></i>
                </button>
                <button class="btn btn-outline-warning btn-sm mx-2">
                  <i class="bi bi-pen"></i>
                </button>
              </td>
            </tr>
            <?php } ?>
            <!--END REGISTROS-->
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Reservation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- action="./php/user_insert.php"-->
        <form method="post" class="needs-validation" novalidate id="form">
          <div class="modal-body">
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Name:</label>
                <input name="txtName" required type="text" class="form-control" placeholder="Put the name">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Place:</label>
                <input name="txtPlace" required min="1" type="number" class="form-control" placeholder="Insert age">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 mb-2">
                <label for="">Departure date</label>
                <input name="txtIda" required type="date" class="form-control" placeholder="Insert departure date">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
              <div class="col-6 mb-2">
                <label for="">Return date</label>
                <input name="txtRegreso" required type="date" class="form-control" placeholder="Insert return date">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Image</label>
                <input name="txtImg" required type="file" class="form-control" placeholder="Insert departure date">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark" id="btnSave">Guardar</button>
            </div>
        </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="./js/reservas.js"></script>


</body>
</body>

</html>