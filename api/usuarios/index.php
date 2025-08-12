<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

require_once "./controller/usuarios.controller.php";
require_once "./dto/usuarios.dto.php";

session_set_cookie_params(3600); // 1 hora
session_start();

$usuariosController = new UsuariosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $usuarioArray = json_decode($data, true);
    if (isset($usuarioArray["id_empleado"])) {
      $usuario = new UsuariosDto($usuarioArray);
      echo $usuariosController->insert($usuario);
    } else if (isset($usuarioArray["email"]) && isset($usuarioArray["password"])) {
      $response = $usuariosController->checkPassword($usuarioArray["email"], $usuarioArray["password"]);
      // echo json_encode($response);
      if ($response["checkPassword"] == true) {
        $_SESSION["user"] = json_encode($response["user"]);
      }
      echo json_encode(["checkPassword" => $response["checkPassword"]]);
    }
    break;
}
