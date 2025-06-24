<?php

class ProyectosDto
{
  public string $titulo;
  public string $descripcion;
  public string $b64Images;
  public string $fecha;

  public function __construct($proyecto)
  {
    $this->titulo = $proyecto["titulo"];
    $this->descripcion = $proyecto["descripcion"];
    $this->b64Images = $proyecto["b64Images"];
    $this->fecha = $proyecto["fecha"];
  }

}