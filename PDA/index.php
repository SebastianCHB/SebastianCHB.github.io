<?php session_start();

if (!isset($_SESSION['userdata'])) {
    // Redirige al login si la sesión no está activa
    header("Location: ../login.php");
    // Desactivar la caché
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROUTIFY ADMINISTRATION PANEL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/routify.css">
  </head>
<body>
    <div class="d-flex"> 
        <!--sidebbar-->
       <?php include "../layouts/aside.php"?>
        <!--end sidebbar-->

        <main class="flex-grow-1">
          <!--Header-->
         <?php include "../layouts/header.php"?>
            <!--end hedear-->
            <!--Row stats-->
            <div class="row mx-4 px-4 my-4" style="padding-top: 30px;">
              <div class="col-4">
                 Fecha Inicio
                <input name="txtEmail" required type="date" class="form-control" placeholder="Insert departure date">
              </div>
              <div class="col-4">
                Fecha Final
                <input name="txtEmail" required type="date" class="form-control" placeholder="Insert departure date">
              </div>
              <div class="col-4">
                <button class="btnrft" style="width: 100%; margin-top: 20px;">Filtrar</class>
              </div>
            </div>
            <div class="row mx-4 px-4 my-4">
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h6><i class="bi bi-wallet"></i>&nbsp;Monthly Income</h6>
                    <h6 class="h3 text-center">$00.00</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h6><i class="bi bi-people-fill"></i>&nbsp;Clients</h6>
                    <h6 class="h3 text-center">0</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h6><i class="fa-solid fa-list-check"></i>&nbsp;Reservations</h6>
                    <h6 class="h3 text-center">00</h6>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="card">
                  <div class="card-body">
                    <h6><i class="bi bi-cash-stack"></i>&nbsp;Debtors </h6>
                    <h6 class="h3 text-center">$00.00</h6>
                  </div>
                </div>
              </div>
            </div>
            <!--end Row stats-->
            <!--charts-->
            <div class="row mx-4 px-4 my-4">
              <div class="col-6">
                <div class="card">
                  <div class="card-header">Monthly income</div>
                  <div class="card-body">
                    <canvas id="chartIngresos"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">  
                  <div class="card-header">Top Reservations</div>
                  <div class="card-body">
                    <canvas id="chartCategorias"></canvas>
                  </div>
                </div>
              </div>
            </div>
            
            <!--end charts-->
        </main>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</body>
</html>