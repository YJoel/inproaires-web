<?php
header("Content-Type: application/json");

require_once "./controller/usuarios.controller.php";
require_once "./dto/usuarios.dto.php";

$usuariosController = new UsuariosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["password"])) {
      echo $usuariosController->checkPassword($_GET["email"], $_GET["password"]);
    }
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $usuarioArray = json_decode($data, true);
    $usuario = new UsuariosDto($usuarioArray);
    echo $usuariosController->insert($usuario);
    break;
}
