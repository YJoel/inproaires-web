<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exportar Horas Extras</title>
  <link rel="shortcut icon" href="./../../../web/img/elice_inproaires_5.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./../css/styles.css">
</head>

<body>
  <div class="container-fluid mb-3">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col"><img src="./../../../web/img/INPROAIRES_LOGO_10.png" alt=""></div>
      <div class="col-2 text-right">

        <a class="btn btn-danger border-light" href="./../">
          <i class="bi bi-caret-left-fill"></i>Regresar
        </a>
      </div>
    </div>

  </div>
  <div class="container">
    <div class="row">
      <div class="col">
        <form name="reporte" class="mx-2 px-3 border border-info">
          &nbsp;
          <h3 class="text-center">
            EXPORTAR HORAS EXTRAS POR MES
          </h3>
          <div class="row">
            <div class="col">
              <input type="month" name="mes" id="mes" class="form-control" required>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary">Generar reporte de Horas Extras</button>
            </div>
          </div>
          &nbsp;
          <!-- <hr> -->
        </form>

      </div>
    </div>
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
  <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
  <!-- <script src="./../../assets/sheetjs/dist/xlsx.full.min.js"></script> -->
  <script src="./../hextras.js"></script>
  <script src="index.js"></script>
</body>

</html>