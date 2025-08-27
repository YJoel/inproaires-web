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
    $stmt = $this->conn->prepare("SELECT h.id, h.nombre, h.cedula, h.fecha, h.diaSemana, h.nHoras, h.hNocturnas, h.hDiurnas, h.hInicio, h.hFin, h.turno, h.festivo FROM $this->dbTable h, empleados e WHERE e.active = 1 and h.cedula = e.cedula");
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
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, null)"
    );

    $int = 0;
    $stmt->bind_param(
      "issisiissss",
      $hextra->cedula,
      $hextra->nombre,
      $hextra->fecha,
      $hextra->nHoras,
      $hextra->diaSemana,
      $hextra->hNocturnas,
      $hextra->hDiurnas,
      $hextra->hInicio,
      $hextra->hFin,
      $hextra->turno,
      $hextra->festivo
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

  public function update($hextra)
  {
    $stmt = $this->conn->prepare(
      "UPDATE $this->dbTable
      SET cedula = ?, nombre = ?, fecha = ?, nHoras = ?,
      diaSemana = ?, hNocturnas = ?, hDiurnas = ?, hInicio = ?,
      hFin = ?, turno = ?, festivo = ? WHERE id = ?"
    );

    $stmt->bind_param(
      "issisiissssi",
      $hextra->cedula,
      $hextra->nombre,
      $hextra->fecha,
      $hextra->nHoras,
      $hextra->diaSemana,
      $hextra->hNocturnas,
      $hextra->hDiurnas,
      $hextra->hInicio,
      $hextra->hFin,
      $hextra->turno,
      $hextra->festivo,
      $hextra->id
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

  public function delete($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM $this->dbTable WHERE id = ?");

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
      $stmt->close();
      return json_encode([
        "error" => 1,
        "message" => "fallo al eliminar el registro"
      ]);
    }
    $stmt->close();
    return json_encode([
      "error" => 0,
      "message" => "registro eliminado con éxito"
    ]);
  }
}