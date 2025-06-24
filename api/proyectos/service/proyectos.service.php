<?php
require_once "./../db/db.php";

class ProyectosService
{
  private $conn = null;
  private $dbTable = "proyectos";

  public function __construct()
  {
    $this->conn = DB::getConnection();
  }

  public function getAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM $this->dbTable");
    $stmt->execute();
    $result = $stmt->get_result();

    $proyectos = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $proyectos[] = $row;
      }
    }

    $stmt->close();

    return json_encode($proyectos);
  }

  public function getById($id)
  {
    $stmt = $this->conn->prepare(
      "SELECT * FROM $this->dbTable
      WHERE BINARY id = $id"
    );

    $stmt->execute();
    $result = $stmt->get_result();

    $proyectos = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $proyectos[] = $row;
      }
    }

    $stmt->close();

    return json_encode($proyectos);
  }

  public function insert($proyecto)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO $this->dbTable VALUES
      (null, ?, ?, ?, ?)"
    );

    $int = 0;
    $stmt->bind_param(
      "ssss",
      $proyecto->titulo,
      $proyecto->descripcion,
      $proyecto->b64Images,
      $proyecto->fecha
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
}