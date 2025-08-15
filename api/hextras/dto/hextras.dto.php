<?php

class HExtrasDto
{
  public int $cedula;
  public string $nombre;
  public string $fecha;
  public int $nHoras;
  public int $hDiurna;
  public int $hNocturna;
  public string $hInicio;
  public string $hFin;
  public string $diaSemana;
  public string $turno;
  public string $festivo;
  public int $id;

  public function __construct($hextra)
  {
    $this->cedula = $hextra["cedula"];
    $this->nombre = $hextra["nombre"];
    $this->fecha = $hextra["fecha"];
    $this->nHoras = $hextra["nHoras"];
    $this->diaSemana = $hextra["diaSemana"];
    $this->hDiurnas = $hextra["hDiurnas"];
    $this->hNocturnas = $hextra["hNocturnas"];
    $this->hInicio = $hextra["hInicio"];
    $this->hFin = $hextra["hFin"];
    $this->turno = $hextra["turno"];
    $this->festivo = $hextra["festivo"];
    if ($hextra["id"] == null) {
      $this->id = 0;
    } else {
      $this->id = $hextra["id"];
    }
  }

}