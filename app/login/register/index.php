<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Inproaires</title>

  <link rel="shortcut icon" href="http://localhost:3000/web/img/elice_inproaires_5.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body>

  <div class="container-form">
    <div class="container-logo">
      <div class="logo">
        <img src="./../../../web/img/INPROAIRES_LOGO_10.png" alt="">
      </div>
    </div>
    <form name="form-login" class="p-4">
      <div class="row">
        <div class="col">
          <label for="email" class="form-label">Correo</label>
          <input type="email" class="form-control" id="email" placeholder="name@inproaires.com"
            pattern="[a-z]+@inproaires.com" required>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="password" placeholder="********" required>
        </div>
      </div>
      <div class="row pt-4">
        <div class="col">
          <button type="submit" class="btn">
            Crear Cuenta
          </button>
        </div>
      </div>
      <script>
        document.getElementById("email").addEventListener("invalid", (event) => {
          event.target.setCustomValidity("Ingrese un correo de la organización");
        });
        document.getElementById("email").addEventListener("input", (event) => {
          event.target.setCustomValidity("");
        });
      </script>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
    integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D"
    crossorigin="anonymous"></script>
  <script src="./../dashboard/proyectos.js"></script>
  <script module src="index.js"></script>
</body>

</html>