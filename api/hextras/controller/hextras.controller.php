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

  public function update($hextra) {
    return $this->hextrasService->update($hextra);
  }

  public function delete($id) {
    return $this->hextrasService->delete($id);
  }
}