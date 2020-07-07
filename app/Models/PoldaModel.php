<?php

namespace App\Models;

use CodeIgniter\Model;

class PoldaModel extends Model
{
  protected $table      = 'd_polda';
  protected $allowedFields = ['nama_polda'];
  protected $primaryKey = 'id_polda';

  protected $useTimestamps = true;

  public function getPolda($id = false)
  {
    if ($id) {
      return $this->where(['id_polda' => $id])->first();
    }
    return $this->findAll();
  }
}
