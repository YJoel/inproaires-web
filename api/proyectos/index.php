<?php
header("Content-Type: application/json");

require_once "./controller/proyectos.controller.php";
require_once "./dto/proyectos.dto.php";

$proyectosController = new ProyectosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["id"])) {
      echo $miembrosController->getById($_GET["id"]);
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
}