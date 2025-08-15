<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://www.inproaires.com.co");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

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
    $hextra = json_decode($data);
    echo $hextrasController->insert($hextra);
    break;
  case "PUT":
    $data = file_get_contents("php://input");
    $hextra = json_decode($data);
    echo $hextrasController->update($hextra);
    break;
  case "DELETE":
    $data = file_get_contents("php://input");
    $id = json_decode($data);
    echo $hextrasController->delete($id->id);
    break;
}