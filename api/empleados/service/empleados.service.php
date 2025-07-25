<?php
require_once "./../db/db.php";

class EmpleadosService
{
  private $conn = null;
  private $dbTable = "empleados";

  public function __construct()
  {
    $this->conn = DB::getConnection();
  }

  public function getAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM $this->dbTable");
    $stmt->execute();
    $result = $stmt->get_result();

    $empleado = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $empleado[] = $row;
      }
    }

    $stmt->close();

    return json_encode($empleado);
  }

  public function getById($id)
  {
    $stmt = $this->conn->prepare(
      "SELECT * FROM $this->dbTable
      WHERE BINARY cedula = $id"
    );

    $stmt->execute();
    $result = $stmt->get_result();

    $empleado = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $empleado[] = $row;
      }
    }

    $stmt->close();

    return json_encode($empleado);
  }

  public function insert($empleado)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO $this->dbTable VALUES
      (null, ?, ?, ?, ?)"
    );

    $int = 0;
    $stmt->bind_param(
      "isss",
      $empleado->cedula,
      $empleado->nombre,
      $empleado->correo,
      $empleado->celular
    );

    if (!$stmt->execute()) {
      $stmt->close();
      return json_encode([
        "error" => 1,
        "message" => "fallo al insertar el registro"
      ]);
    }
    $stmt->close();
    return json_encode([
      "error" => 0,
      "message" => "registro insertado con éxito"
    ]);
  }

  public function update($id, $empleado)
  {
    return;
  }
}