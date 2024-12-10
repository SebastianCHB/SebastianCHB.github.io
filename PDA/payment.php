<?php session_start();
    if(isset($_SESSION['userdata'])){
      $user=$_SESSION['userdata'];
    }else{
      header("Location: ./login.php");
    }
include "./php/conexion.php";
$sql="select * from paquete_viaje order by id_paquete ASC ";
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
        <h1 class="h4">Paquete Viaje</h1>
        <div>
          <button class="btnrft btn-dark btnrtf" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
        </div>
      </div>
      <!--end Title section-->
      <section class="mt-4 p-4">
        <table class="table">
          <thead>
            <tr>
            <th scope="col">ID_PAQUETE</th>
              <th scope="col">NOMBRE_PAQUETE</th>
              <th scope="col">DESCRIPCION</th>
              <th scope="col">PRECIO</th>
              <th scope="col">DURACION</th>
              <th scope="col">IMAGEN</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            while($fila=mysqli_fetch_array($res)){
            ?>
            <tr>
              <td><?php echo $fila['id_paquete']?></td>
              <td><?php echo $fila['nombre_paquete']?></td>
              <td><?php echo $fila['descripcion']?></td>
              <td><?php echo $fila['precio']?></td>
              <td><?php echo $fila['duracion']?></td>
              <td><?php echo $fila['imagen']?></td>
              <td class="text-end">
                
              <button class="btn btn-outline-danger btn-sm mx-2 btnDelete" data-id="<?= $fila['id_paquete']; ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
  <i class="bi bi-trash"></i>
</button>



<button class="btn btn-outline-warning btn-sm mx-2 btnEdit"
        data-id="<?= $fila['id_paquete']; ?>"
        data-name="<?= $fila['nombre_paquete']; ?>"
        data-desc="<?= $fila['descripcion']; ?>"
        data-price="<?= $fila['precio']; ?>"
        data-durac="<?= $fila['duracion']; ?>"
        data-img="<?= $fila['imagen']; ?>"
        data-bs-toggle="modal" data-bs-target="#modalEdit">
  <i class="bi bi-pen"></i>
</button>



              </td>
              </tr>
              <?php }  ?>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Paquete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./php/productoadd.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate id="form">
          <div class="modal-body">
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Nombre:</label>
                <input name="txtNamee" required type="text" class="form-control" placeholder="Coloca el nombre">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Descripcion:</label>
                <input name="txtDesc" type="text" class="form-control" placeholder="Escribe la descripcion">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-6 mb-2">
                <label for="">Precio</label>
                <input name="txtPrice" required type="number" class="form-control" placeholder="Precio del paquete">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
              <div class="col-6 mb-2">
                <label for="">Duracion</label>
                <input name="txtDuracion" required type="text" class="form-control" placeholder="Duracion del viaje">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Imagen</label>
                <input accept="image/*" name="txtImg" required type="file" class="form-control" placeholder="#">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
              </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark" id="btnSave2">Guardar</button>
            </div>
          </div>
        </form>
      </div> 
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteLabel">¿Estás seguro de eliminar este paquete?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¡Este paquete será eliminado permanentemente!</p>
      </div>
      <div class="modal-footer">
        <form action="./php/eliminar.php" method="POST">
          <!-- Campo oculto que recibe el id_paquete -->
          <input type="hidden" name="id_paquete" id="deleteIdPaquete">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
          
<!-- Modal de edición -->
<div class="modal fade modal-lg" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditLabel">Editar Paquete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="./php/updatepaquete.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate id="form2">
    <div class="modal-body">
        <div class="row">
            <div class="col-12 mb-2">
                <label for="">Nombre:</label>
                <input id="pname" name="txtNamee" required type="text" class="form-control" placeholder="Coloca el nombre">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2">
                <label for="">Descripcion:</label>
                <input id="pdesc" name="txtDesc" type="text" class="form-control" placeholder="Escribe la descripcion">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Required field</div>
            </div>
        </div>
        <div class="col-6 mb-2">
            <label for="">Precio</label>
            <input id="pprecio" name="txtPrice" required type="number" class="form-control" placeholder="Precio del paquete">
            <div class="valid-feedback">Correct</div>
            <div class="invalid-feedback">Required field</div>
        </div>
        <div class="col-6 mb-2">
            <label for="">Duracion</label>
            <input id="pduracion" name="txtDuracion" required type="text" class="form-control" placeholder="Duracion del viaje">
            <div class="valid-feedback">Correct</div>
            <div class="invalid-feedback">Required field</div>
        </div>
        <div class="row">
  <div class="col-12 mb-2">
    <label for="">Imagen</label>
    <input id="pimg" accept="image/*" name="txtImg" required type="file" class="form-control" placeholder="#">
    <div id="img-name"></div> 
  </div>
</div>

        <input type="hidden" name="txtId" id="txtId">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark" id="btnSave2">Guardar</button>
        </div>
    </div>
</form>

    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="./js/paymentdelete.js"></script>
    <script src="./js/payment.js"></script>
    <?php  
      if(isset($_GET['status'])){
        if($_GET['status']==1){
    ?> 
          <script>
            const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: "success",
        title: "Datos guardados"
      });
          </script>

    <?php
        }
      }
    ?>


</body>
</body>

</html>