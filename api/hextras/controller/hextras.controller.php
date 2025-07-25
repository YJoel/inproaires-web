<?php

require_once "./dto/hextras.dto.php";

class HExtrasController
{
  private $hextrasService = null;

  public function __construct()
  {
    require_once "./service/hextras.service.php";
    $this->hextrasService = new HExtrasService();
  }

  public function getAll()
  {
    return $this->hextrasService->getAll();
  }

  public function getById($id)
  {
    return $this->hextrasService->getById($id);
  }

  public function insert($hextra) {
    return $this->hextrasService->insert($hextra);
  }

  public function update($id, $hextra) {
    return $this->hextrasService->update($id, $hextra);
  }
}