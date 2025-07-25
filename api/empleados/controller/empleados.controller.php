<?php

require_once "./dto/empleados.dto.php";

class EmpleadosController
{
  private $empleadosService = null;

  public function __construct()
  {
    require_once "./service/empleados.service.php";
    $this->empleadosService = new empleadosService();
  }

  public function getAll()
  {
    return $this->empleadosService->getAll();
  }

  public function getById($id)
  {
    return $this->empleadosService->getById($id);
  }

  public function insert($empleado) {
    return $this->empleadosService->insert($empleado);
  }

  public function update($id, $empleado) {
    return $this->empleadosService->update($id, $empleado);
  }
}