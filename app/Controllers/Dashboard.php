<?php

namespace App\Controllers;



class Dashboard extends BaseController
{
  protected $data;
  public function __construct()
  {
    // helper('form');

    // $this->form_validation = \Config\Services::validation();
    // $this->AuthModel = new AuthModel();

    $this->data =  [
      'title' => 'Dashboard',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor'
    ];
  }

  public function index()
  {
    if ($this->status === 400) {
      return redirect()->route('/');
    }

    $data = [
      'group' => $this->Group
    ];

    $data = array_merge($data, $this->data);
    $data = array_merge($data, $this->sesi);
    return view('dashboard_v', $data);
  }

  //--------------------------------------------------------------------

}
