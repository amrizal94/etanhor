<?php

namespace App\Models;

use CodeIgniter\Model;

class PolsekModel extends Model
{
  protected $table      = 'd_polsek';
  protected $allowedFields = ['id_polres', 'nama_polsek'];
  protected $primaryKey = 'id_polsek ';

  protected $useTimestamps = true;

  public function getPolsek($id = false)
  {
    if ($id) {
      return $this->where(['id_polsek ' => $id])->first();
    }
    $db      = \Config\Database::connect();
    $builder = $db->table('d_polsek');
    $builder->select('*');
    $builder->join('d_polres', 'd_polres.id_polres = d_polsek.id_polres');
    $query = $builder->get();
    return $query->getResultArray();
  }
}
