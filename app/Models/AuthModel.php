<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
  protected $table      = 'd_user';
  protected $allowedFields = ['last_login', 'ip_login', 'token'];
  // protected $allowedFields = ['ip_login'];
  protected $primaryKey = 'username';

  protected $useTimestamps = true;

  public function get_user($user = false, $data = false)
  {
    if ($user && !$data) {
      return $this->where(['username' => $user])->first();
    }

    if ($user && $data) {
      // return $data;
      $this->update(['username' => $user], $data);
    }
  }
}
