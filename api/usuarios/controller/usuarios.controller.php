<?php

require_once "./dto/usuarios.dto.php";

class UsuariosController
{
  private $usuariosService = null;

  public function __construct()
  {
    require_once "./service/usuarios.service.php";
    $this->usuariosService = new UsuariosService();
  }

  public function checkPassword($email, $password)
  {
    return $this->usuariosService->checkPassword($email, $password);
  }

  public function insert(UsuariosDto $usuario)
  {
    return $this->usuariosService->insert($usuario);
  }
}