<?php

session_start();

// Cookie para mantener la sesión durante un tiempo determinado
$user = "";
if (isset($_COOKIE['user'])) {
  $user = json_decode($_COOKIE['user']);
  // echo "<script> console.log('$user') </script>";
} else {
  header("location: ./../../login/");
}

if (isset($_GET["logout"])) {
  setcookie("id", "", time() - 3600, "/");
  header("location: ./../../login/");
  exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Horas Extras</title>
  <link rel="shortcut icon" href="./../../../web/img/elice_inproaires_5.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="./../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />
  <link href="./../css/sb-admin-2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
        <div class="sidebar-brand-icon">
          <img src="./../../../web/img/elice_inproaires_5.png" width="30" height="30" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">INPROAIRES</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="./../">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Empleados</div>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="">Buttons</a>
            <a class="collapse-item" href="">Cards</a>
          </div>
        </div>
      </li> -->

      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
          aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="">Colors</a>
            <a class="collapse-item" href="">Borders</a>
            <a class="collapse-item" href="">Animations</a>
            <a class="collapse-item" href="">Other</a>
          </div>
        </div>
      </li> -->

      <!-- Divider -->
      <!-- <hr class="sidebar-divider" /> -->

      <!-- Heading -->
      <!-- <div class="sidebar-heading">Addons</div> -->

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="">Login</a>
            <a class="collapse-item" href="">Register</a>
            <a class="collapse-item" href="">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="">404 Page</a>
            <a class="collapse-item" href="">Blank Page</a>
          </div>
        </div>
      </li> -->

      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Horas Extras</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="./../proyectos/">
          <i class="fas fa-fw fa-table"></i>
          <span>Proyectos</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <button type="button" class="btn btn-light">
              <i class="bi bi-clock d-inline-block"></i>
              <div id="time" class="d-inline-block"></div>
            </button>
            <script>
              setInterval(() => {
                const date = new Date();
                let hora = date.getHours() < 10 ? `0${date.getHours()}` : date.getHours();
                let minutes = date.getMinutes() < 10 ? `0${date.getMinutes()}` : date.getMinutes();
                // let seconds = date.getSeconds() < 10 ? `0${date.getSeconds()}` : date.getSeconds();

                document.getElementById("time").innerHTML = `
                   ${hora}:${minutes}
                `;
              }, 1000)
            </script>
          </div>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php echo $user->nombre . "<br>" . $user->email; ?>
                </span>
                <img class="img-profile rounded-circle" src="./../img/undraw_profile.svg" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row d-flex my-2">
            <div class="col">

            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Registro de horas extras
                  </h6>
                </div>
                <div class="card-body">
                  <form name="registro-horas-extras">
                    <div class="row">
                      <div class="col">
                        <div class="form-floating mb-3">
                          <!-- <input type="number" class="form-control" id="cedula" name="cedula" placeholder="1234567890" required> -->
                          <select class="form-select" name="cedula" id="cedula">
                          </select>
                          <label for="cedula">Empleado</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-floating">
                          <select class="form-select" id="turnoTrabajo" name="turnoTrabajo"
                            aria-label="Floating label select example">
                            <option value="Hoteles">Hoteles</option>
                            <option value="Clientes Ocasionales">Clientes Ocasionales</option>
                          </select>
                          <label for="floatingSelect">Seleccione su turno</label>
                        </div>
                      </div>
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <input type="date" name="fecha" id="fecha" class="form-control mt-1 p-4" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mx-4 py-2">
                        <input class="form-check-input" type="checkbox" value="" id="festivo" name="festivo">
                        <label class="form-check-label" for="checkDefault">
                          Dia Festivo
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="input-group mb-3">
                          <span class="input-group-text">Hora de Inicio</span>
                          <input type="time" class="form-control" name="hInicio" id="hInicio" required>
                          <span class="input-group-text">Hora de Fin</span>
                          <input type="time" class="form-control" name="hFin" id="hFin" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col py-2 px-3 my-3">
                        <button type="submit" class="btn btn-primary" id="registrar" name="registrar">
                          Registrar Horas Extras
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="row">
                <div class="col">
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Exportar horas extras por mes</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <form name="reporte" class="mx-2 px-3">
                            <div class="row">
                              <div class="col">
                                <input type="month" name="mes" id="mes" class="form-control" required>
                              </div>
                              <div class="col">
                                <button type="submit" class="btn btn-success">
                                  <i class="bi bi-filetype-xlsx"></i>
                                  Exportar Horas Extras
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <!-- <h4>ESTADISTICAS</h4> -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <div class="row">
                        <div class="col">
                          <h6 class="m-2 font-weight-bold text-primary">Horas Totales por trabajador</h6>
                        </div>
                        <div class="col">
                          <input type="month" class="form-control" name="filtroMes" id="filtroMes"
                            onchange="actualizarTabla(this)">
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div>
                            <canvas id="horasTotales"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 p-2 font-weight-bold text-primary">Listado de Horas Extras</h6>
                </div>
                <div class="card-body">
                  <table id="hExtras" class="display">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Fecha</th>
                        <th>Dia Semana</th>
                        <th># horas Extras</th>
                        <th>Horas diurnas</th>
                        <th>Horas Nocturnas</th>
                        <th>Festivo</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; INPROAIRES SAS 2025</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

  </div>
  <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Seleccione "Cerrar Sesión" para abandonar la sesión actual
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" onclick="cerrarSesion()">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body text-white">
        <i class="bi bi-check-circle-fill"></i> Horas extras registradas
      </div>
    </div>
  </div>

  <script src="./../vendor/jquery/jquery.min.js"></script>
  <script src="./../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="./../js/sb-admin-2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
  <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const dominio = "www.inproaires.com.co";
  </script>
  <script src="utilities.js"></script>
  <script src="empleados.js"></script>
  <script src="hextras.js"></script>
  <script src="index.js"></script>
</body>

</html>