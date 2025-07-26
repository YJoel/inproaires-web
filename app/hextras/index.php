<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Horas Extras</title>
  <link rel="shortcut icon" href="./../../web/img/elice_inproaires_5.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
  <div class="container-fluid mb-3">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col"><img src="./../../web/img/INPROAIRES_LOGO_10.png" alt=""></div>
      <div class="col-2 text-right">

        <button class="btn border-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
          aria-controls="offcanvasExample">
          <i class="bi bi-list"></i>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
          aria-labelledby="offcanvasExampleLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <hr>
          <div class="offcanvas-body">
            <div class="row">
              <div class="col">
                <a class="btn btn-success" href="./export/">Reporte de horas</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="container">
    <h4>
      FORMULARIO DE REGISTRO DE HORAS EXTRAS
    </h4>
    <hr>
    <form name="registro-horas-extras">
      <div class="row">
        <div class="col-10">
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="cedula" name="cedula" placeholder="1234567890" required>
            <label for="cedula">Cedula</label>
          </div>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-primary p-3" onclick="buscarEmpleado()">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre" placeholder="" readonly required>
            <label for="nombre">Nombre del Empleado</label>
          </div>
        </div>
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
      </div>
      <div class="row">
        <div class="col">
          <div class="row">
            <div class="col">
              <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="col p-2">
              <input class="form-check-input" type="checkbox" value="" id="festivo" name="festivo">
              <label class="form-check-label" for="checkDefault">
                Dia Festivo
              </label>
            </div>
          </div>

        </div>
        <div class="col">
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
          <button type="submit" class="btn btn-success" id="registrar" name="registrar">
            Registrar Horas Extras
          </button>
        </div>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK"
    crossorigin="anonymous"></script>
  <script>
    const dominio = "www.inproaires.com.co";
  </script>
  <script src="empleados.js"></script>
  <script src="hextras.js"></script>
  <script src="index.js"></script>
</body>

</html>