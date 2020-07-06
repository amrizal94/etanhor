<?php

namespace App\Controllers;

class Ajuan extends BaseController
{
  public function __construct()
  {
    // helper('form');
    // $this->form_validation = \Config\Services::validation();

    $this->data =  [
      'title' => 'Ajuan',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor'
    ];
  }

  public function index()
  {
    if ($this->sesi === 400) {
      return redirect()->route('/');
    }

    $data = [
      'group' => $this->Group
    ];

    $data = array_merge($data, $this->data);
    return view('ajuan/view', $data);
  }

  //--------------------------------------------------------------------

}
