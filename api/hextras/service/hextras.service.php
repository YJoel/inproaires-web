<?php
require_once "./../db/db.php";

class HExtrasService
{
  private $conn = null;
  private $dbTable = "hextras";

  public function __construct()
  {
    $this->conn = DB::getConnection();
  }

  public function getAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM $this->dbTable");
    $stmt->execute();
    $result = $stmt->get_result();

    $hextra = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hextra[] = $row;
      }
    }

    $stmt->close();

    return json_encode($hextra);
  }

  public function getById($id)
  {
    $stmt = $this->conn->prepare(
      "SELECT * FROM $this->dbTable
      WHERE BINARY cedula = $id"
    );

    $stmt->execute();
    $result = $stmt->get_result();

    $hextra = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $hextra[] = $row;
      }
    }

    $stmt->close();

    return json_encode($hextra);
  }

  public function insert($hextra)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO $this->dbTable VALUES
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    $int = 0;
    $stmt->bind_param(
      "issisiisss",
      $hextra->cedula,
      $hextra->nombre,
      $hextra->fecha,
      $hextra->nHoras,
      $hextra->diaSemana,
      $hextra->hNocturnas,
      $hextra->hDiurnas,
      $hextra->hInicio,
      $hextra->hFin,
      $hextra->turno
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

  public function update($id, $hextra)
  {
    return;
  }
}