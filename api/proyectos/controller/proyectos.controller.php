<?php

require_once "./dto/proyectos.dto.php";

class ProyectosController
{
  private $proyectosService = null;

  public function __construct()
  {
    require_once "./service/proyectos.service.php";
    $this->proyectosService = new ProyectosService();
  }

  public function getAll()
  {
    return $this->proyectosService->getAll();
  }

  public function getById($id)
  {
    return $this->proyectosService->getById($id);
  }

  public function insert($proyecto) {
    return $this->proyectosService->insert($proyecto);
  }

  public function update($id, $proyecto) {
    return $this->proyectosService->update($id, $proyecto);
  }
}