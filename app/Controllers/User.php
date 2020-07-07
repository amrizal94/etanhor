<?php

namespace App\Controllers;

use App\Models\UselLevelModal;

class User extends BaseController
{
  protected $data;
  protected $UselLevelModal;
  public function __construct()
  {

    $this->UselLevelModal = new UselLevelModal();

    $this->data =  [
      'title' => 'User',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor',
      'mtitle' => 'Form tambah data user'
    ];
  }

  public function index()
  {
    if ($this->sesi === 400) {
      return redirect()->route('/');
    }
    $data = [
      'group' => $this->Group,
      'level' => $this->UselLevelModal->get_u_level(session()->getTempdata('level_user'))
    ];

    $data = array_merge($data, $this->data);

    return view('user/list', $data);
  }

  public function create()
  {
    if ($this->sesi === 400) {
      return redirect()->route('/');
    }
  }
  //--------------------------------------------------------------------

}
