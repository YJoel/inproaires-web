<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

require_once "./controller/usuarios.controller.php";
require_once "./dto/usuarios.dto.php";

$usuariosController = new UsuariosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $usuarioArray = json_decode($data, true);
    if (isset($usuarioArray["email"]) && isset($usuarioArray["password"])) {
      $response = $usuariosController->checkPassword($usuarioArray["email"], $usuarioArray["password"]);
      // echo json_encode($response);
      if ($response["checkPassword"] == true) {
        setcookie(
          "user",
          json_encode($response["user"]),
          time() + 3600,
          "/",
          "",
          true,
          true
        );
      }
      echo json_encode(["checkPassword" => $response["checkPassword"]]);
    } else {
      $usuario = new UsuariosDto($usuarioArray);
      echo $usuariosController->insert($usuario);
    }
    break;
}
