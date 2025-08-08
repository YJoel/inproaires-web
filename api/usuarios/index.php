<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./controller/usuarios.controller.php";
require_once "./dto/usuarios.dto.php";

$usuariosController = new UsuariosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["password"])) {
      $response = $usuariosController->checkPassword($_GET["email"], $_GET["password"]);
      // echo json_encode($response);
      if ($response["checkPassword"] == true) {
        setcookie(
          "user",
          json_encode($response["user"]),
          [
            "expires" => time() + 3600,
            "path" => "/",
            // "secure" => true, // Solo por HTTPS
            "httponly" => true // No accesible por JavaScript
          ]
        );
      }
      echo json_encode(["checkPassword" => $response["checkPassword"]]);
    }
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $usuarioArray = json_decode($data, true);
    $usuario = new UsuariosDto($usuarioArray);
    echo $usuariosController->insert($usuario);
    break;
}
