<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
  protected $AuthModel;
  protected $data;
  public function __construct()
  {

    $this->form_validation = \Config\Services::validation();
    $this->AuthModel = new AuthModel();

    $this->data =  [
      'title' => 'LOGIN',
    ];
  }
  public function index()
  {
    $data = [
      'group' => $this->Group
    ];

    $data = array_merge($data, $this->data);
    // dd($data);
    return view('auth', $data);
  }

  public function auth()
  {

    $signin = $this->request->getPost('signin');
    if (isset($signin)) {
      // dd("ok");
      $username  = $this->request->getPost('username');
      $password   = $this->request->getPost('password');
    } else {
      return redirect()->route('/');
    }
    $data = [
      'group' => $this->Group
    ];
    $data = array_merge($data, $this->data);
    $cek = [
      'username'  => $username,
      'password'  => $password
    ];
    // dd("ok");

    if (!$this->form_validation->run($cek, 'auth')) {
      // mengembalikan nilai input yang sudah dimasukan sebelumnya
      // memberikan pesan error pada saat input data
      if ($this->form_validation->getError('username')) {
        session()->setFlashdata('username', '<div class ="alert alert-danger" role="alert"><b>' . $this->form_validation->getError('username') . '</b></div>');
      }
      if ($this->form_validation->getError('password')) {
        session()->setFlashdata('inputs', $username);
        session()->setFlashdata('password', '<div class ="alert alert-danger" role="alert"><b>' . $this->form_validation->getError('password') . '</b></div>');
      }
      // kembali ke halaman form
      return view('auth', $data);
    } else {
      return $this->_login($username, $password);
    }
  }

  protected function _login($user = false, $password = false)
  {
    if (!$user) {
      return redirect()->back();
    }
    if (!$password) {
      return redirect()->back();
    }
    $cek = $this->AuthModel->get_user($user);
    if ($cek) {
      if (password_verify($password, $cek['password'])) {
        $data = [
          // 'id' => $cek['id']
          'username' => $cek['username'],
          // 'nrp' => $cek['nrp'],
          // 'status' => $cek['status'],
          // 'role_id' => $cek['role_id'],
          'last_login' => $cek['last_login']
          // 'last_logout' => $cek['last_logout']
        ];
        session()->setTempdata($data);
        $ip_client = $_SERVER['REMOTE_ADDR'];
        if ($ip_client == "::1") {
          $ip_client = "localhost";
        }
        // $myTime = Time::now('Asia/Jakarta', 'en_US');
        $data = array(
          'last_login' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
          'ip_login' => $ip_client
        );
        // $user = $this->AuthModel->update(1, $data);
        $this->AuthModel->get_user($user, $data);
        // dd($data);

        return redirect()->to('/Dashboard');
      } else {
        session()->setFlashdata('inputs', $user);
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Wrong password!</b></div>');
        return redirect()->route('/');
      }
    } else {
      session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Username is not registered!</b></div>');
      return redirect()->route('/');
    }
  }

  //--------------------------------------------------------------------

}
