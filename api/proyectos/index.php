<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./controller/proyectos.controller.php";
require_once "./dto/proyectos.dto.php";

$proyectosController = new ProyectosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["id"])) {
      echo $proyectosController->getById($_GET["id"]);
    } else {
      echo $proyectosController->getAll();
    }
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $proyectoArray = json_decode($data, true);
    $proyectoArray["b64Images"] = json_encode($proyectoArray["b64Images"]);
    $proyecto = new ProyectosDto($proyectoArray);
    echo $proyectosController->insert($proyecto);
    break;
  case "PUT":
    $data = file_get_contents("php://input");
    $proyectoArray = json_decode($data, true);
    $id = $proyectoArray["id"];
    $proyecto = new ProyectosDto($proyectoArray["proyecto"]);
    echo $proyectosController->update($id, $proyecto);
    break;
}