<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once "./controller/empleados.controller.php";
require_once "./dto/empleados.dto.php";

$empleadosController = new EmpleadosController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["id"])) {
      echo $empleadosController->getById($_GET["id"]);
    } else {
      echo $empleadosController->getAll();
    }
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $empleadosArray = json_decode($data, true);
    $empleado = new EmpleadosDto($empleadosArray);
    echo $empleadosController->insert($empleado);
    break;
  case "PUT":
    $data = file_get_contents("php://input");
    $empleadosArray = json_decode($data, true);
    $id = $empleadosArray["cedula"];
    $empleado = new EmpleadosDto($empleadosArray["empleado"]);
    echo $empleadosController->update($id, $empleado);
    break;
}