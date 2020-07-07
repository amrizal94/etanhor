<?php

namespace App\Models;

use CodeIgniter\Model;

class PolresModal extends Model
{
  protected $table      = 'd_polres';
  protected $allowedFields = ['id_polda', 'nama_polres'];
  protected $primaryKey = 'id_polres ';

  protected $useTimestamps = true;

  public function getPolres($id = false)
  {
    if ($id) {
      return $this->where(['id_polres ' => $id])->first();
    }
    $db      = \Config\Database::connect();
    $builder = $db->table('d_polres');
    $builder->select('*');
    $builder->join('d_polda', 'd_polda.id_polda = d_polres.id_polda');
    $query = $builder->get();
    return $query->getResultArray();
  }
}
