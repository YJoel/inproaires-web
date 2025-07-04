<?php
require_once "./../db/db.php";

class UsuariosService
{
  private $conn = null;
  private $dbTable = "usuarios";

  public function __construct()
  {
    $this->conn = DB::getConnection();
  }

  public function checkPassword($email, $password)
  {
    $stmt = $this->conn->prepare(
      "SELECT password FROM usuarios
      WHERE email = ?"
    );

    $stmt->bind_param(
      "s",
      $email
    );

    $stmt->execute();
    $result = $stmt->get_result();

    $usuarios = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
      }
    }

    $stmt->close();

    return json_encode([
      "user" => password_verify($password, $usuarios[0]["password"])
    ]);
  }

  public function insert($usuario)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO $this->dbTable VALUES
      (null, ?, ?, ?, ?)"
    );

    $hashPassword = password_hash($usuario->password, PASSWORD_DEFAULT);
    $stmt->bind_param(
      "issi",
      $usuario->id_empleado,
      $usuario->email,
      $hashPassword,
      $usuario->id_rol
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