<?php

namespace App\Models;

use CodeIgniter\Model;

class UselLevelModal extends Model
{
  protected $table      = 'm_u_level';
  // protected $allowedFields = ['last_login', 'ip_login', 'token'];
  protected $primaryKey = 'id';

  // protected $useTimestamps = true;

  public function get_u_level($level = false)
  {
    $count = $this->findAll();
    $count = count($count);
    if (!$level) {
      return false;
    } else {
      if ($level == 1) {
        return $this->findAll();
      }
      $l =  $level - 1;
      $count = $count - $l;
      if ($level == 2) {

        return $this->findAll($count, $l);
      }
      if ($level == 3) {
        return $this->findAll($count, $l);
      }
    }
  }
}
