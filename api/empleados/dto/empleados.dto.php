<?php

class EmpleadosDto
{
  public int $cedula;
  public string $nombre;
  public string $correo;
  public string $celular;

  public function __construct($empleado)
  {
    $this->cedula = $empleado["cedula"];
    $this->nombre = $empleado["nombre"];
    $this->correo = $empleado["correo"];
    $this->celular = $empleado["celular"];
  }

}