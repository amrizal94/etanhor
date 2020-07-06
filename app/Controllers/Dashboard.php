<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Dashboard extends BaseController
{

  protected $AuthModel;
  protected $data;
  protected $sesi;
  public function __construct()
  {
    // helper('form');
    helper('date');
    // $this->form_validation = \Config\Services::validation();
    $this->AuthModel = new AuthModel();

    $this->data =  [
      'title' => 'Dashboard',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor'
    ];

    if (session()->getTempdata()) {
      $this->sesi = session()->getTempdata();
    }
  }

  public function index()
  {
    if (!$this->sesi) {
      return redirect()->route('/');
    } else {

      $cek = $this->AuthModel->get_user($this->sesi['username']);
      // dd($cek);
      if ($cek) {
        $cek = $cek['token'];
        if (!$cek == $this->sesi['token']) {
          session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Please Login</b></div>');
          return redirect()->route('/');
        }
      } else {
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Username is not registered!</b></div>');
        return redirect()->route('/');
      }
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
