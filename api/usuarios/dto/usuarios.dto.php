<?php

class UsuariosDto
{
  public string $email;
  public string $password;
  public int $id_empleado;
  public int $id_rol;

  public function __construct($usuario)
  {
    $this->email = $usuario["email"];
    $this->password = $usuario["password"];
    $this->id_empleado = $usuario["id_empleado"];
    $this->id_rol = $usuario["id_rol"];
  }
}