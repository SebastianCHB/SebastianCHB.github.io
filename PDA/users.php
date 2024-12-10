<?php session_start();

if (!isset($_SESSION['userdata'])) {
    // Redirige al login si la sesión no está activa
    header("Location: ../login.php");
    exit();
}
// Desactivar la caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

include "./php/conexion.php";
$sql="select * from users";
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
        <h1 class="h4">Users</h1>
        <div>
          <button class="btnrft btn-dark btnrtf" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
        </div>
      </div>
      <!--end Title section-->
      <section class="mt-4 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">NOMBRE</th>
              <th scope="col">ROL</th>
              <th scope="col">EMAIL</th>
              <th scope="col">CONTRASEÑA</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            while($fila=mysqli_fetch_array($res)){
            ?>
            <tr>
              <td><?php echo $fila['id_user']?></td>
              <td><?php echo $fila['nombre']?></td>
              <td><?php if($fila['rol'] == 1){
                echo "<span class='rounded bg-success text-white p-1'>Administrador";
              }else{
                echo "<span class='rounded bg-dark text-white p-1'>Usuario";
              } ?></td>
              <td><?php echo $fila['email']?></td>
              <td>**********</td>
              <td class="text-end">
              <button class="btn btn-outline-danger btn-sm btnDelete" 
                      data-id="<?php echo $fila['id_user']; ?>" 
                      data-bs-toggle="modal" 
                      data-bs-target="#modalDelete">
                 <i class="bi bi-trash2"></i>
                </button>


                <button 
    class="btn btn-outline-warning btn-sm mx-2 btnEdit" 
    data-id="<?php echo $fila['id_user']; ?>" 
    data-name="<?php echo $fila['nombre']; ?>" 
    data-email="<?php echo $fila['email']; ?>" 
    data-bs-toggle="modal" 
    data-bs-target="#modalEdit">
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
  <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="modalAdd" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Administrador</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./php/user_insert.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate id="form2">
          <div class="modal-body">
          <input type="hidden" name="txtId">
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Name:</label>
                <input id="txtname" name="txtName" required type="text" class="form-control" placeholder="Insert name">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Invalid data</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Email</label>
                <input id="txtemail" name="txtEmail" required type="email" class="form-control" placeholder="Insert email">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Invalid data</div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 mb-2">
                <label for="">Password</label>
                <input id="txtpassword" name="txtPassword" required type="password" class="form-control" placeholder="Insert password">
                <div class="valid-feedback">Correct</div>
                <div class="invalid-feedback">Invalid data</div>
              </div>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark" id="btnSave2">Guardar</button>
            </div>
        </form>
        
      </div>
    </div>
  </div>
  
    <!-- Modal para Eliminar -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalDeleteLabel">Confirmar Eliminación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deleteForm" action="./php/delete.php" method="post">
  <input type="hidden" name="id_user" id="deleteId">
  <div class="modal-body">
    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-danger">Eliminar</button>
  </div>
</form>

    </div>
  </div>
</div>



  <!-- Modal Edit -->
  <div class="modal fade modal-lg" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit user</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" action="./php/update.php" method="post">
        <input type="hidden" id="txtIdEdit" name="txtIdd">

  <div class="modal-body">
    <div class="mb-3">
      <label for="txtNamee" class="form-label">Nombre:</label>
      <input type="text" class="form-control" id="txtNamee" name="txtName" required>
    </div>
    <div class="mb-3">
      <label for="txtEmaill" class="form-label">Email:</label>
      <input type="email" class="form-control" id="txtEmaill" name="txtEmail" required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-warning">Actualizar</button>
  </div>
</form>

        
      </div>
    </div>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="./js/usersdelete.js"></script>        
      <script src="./js/users.js"></script>
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