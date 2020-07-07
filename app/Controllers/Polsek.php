<?php

namespace App\Controllers;

class Polsek extends BaseController
{
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

    return view('polsek/list', $data);
  }

  //--------------------------------------------------------------------

}
