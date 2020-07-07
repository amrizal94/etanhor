<?php

namespace App\Models;

use CodeIgniter\Model;

class PolresModel extends Model
{
  protected $table      = 'd_polres';
  protected $allowedFields = ['id_polda', 'nama_polres', 'slug_polres', 'slug_polda'];
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
    $builder->join('d_polda', 'd_polda.slug_polda = d_polres.slug_polda');
    $query = $builder->get();
    return $query->getResultArray();
  }
}
