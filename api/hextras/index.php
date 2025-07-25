<?php
header("Content-Type: application/json");

require_once "./controller/hextras.controller.php";
require_once "./dto/hextras.dto.php";

$hextrasController = new HExtrasController();
switch ($_SERVER["REQUEST_METHOD"]) {
  case "GET":
    if (isset($_GET["id"])) {
      echo $hextrasController->getById($_GET["id"]);
    } else {
      echo $hextrasController->getAll();
    }
    break;
  case "POST":
    $data = file_get_contents("php://input");
    $extrasArray = json_decode($data, true);
    $hextra = new HExtrasDto($extrasArray);
    echo $hextrasController->insert($hextra);
    break;
  case "PUT":
    $data = file_get_contents("php://input");
    $extrasArray = json_decode($data, true);
    $id = $extrasArray["cedula"];
    $hextra = new HExtrasDto($extrasArray["hextra"]);
    echo $hextrasController->update($id, $hextra);
    break;
}