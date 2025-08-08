<?php

class UsuariosDto
{
  public string $email;
  public string $password;
  public int $id_empleado;
  public string $rol;
  public string $nombre;

  public function __construct($usuario)
  {
    $this->email = $usuario["email"];
    $this->password = $usuario["password"];
    $this->id_empleado = $usuario["id_empleado"];
    $this->rol = $usuario["rol"];
    $this->nombre = $usuario["nombre"];
  }
}