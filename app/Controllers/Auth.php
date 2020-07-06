<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
  protected $AuthModel;
  protected $data;
  protected $sesi;
  public function __construct()
  {
    helper('form');
    helper('date');
    $this->form_validation = \Config\Services::validation();
    $this->AuthModel = new AuthModel();

    $this->data =  [
      'title' => 'LOGIN',
      'body' => 'login-page'
    ];
    if (session()->getTempdata()) {
      $this->sesi = session()->getTempdata();
      return $this->_login("sesi", "sesi", $this->sesi);
    }
  }
  public function index()
  {
    if ($this->sesi === 200) {
      return redirect()->to('/Dashboard');
    }
    $data = [
      'group' => $this->Group
    ];

    $data = array_merge($data, $this->data);
    return view('auth_v', $data);
  }

  public function auth()
  {
    if ($this->sesi === 200) {
      return redirect()->to('/Dashboard');
    }

    $signin = $this->request->getPost('signin');
    if (isset($signin)) {
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
      return view('auth_v', $data);
    } else {
      return $this->_login($username, $password, false);
    }
  }

  protected function _login($user = false, $password = false, $sesi = false)
  {
    if (!$user) {
      return redirect()->back();
    }
    if (!$password) {
      return redirect()->back();
    }
    if ($sesi) {
      $cek = $this->AuthModel->get_user($sesi['username']);
      if ($cek) {
        $cek = $cek['token'];
        if ($cek == $sesi['token']) {
          $this->_loginProcess($sesi['username'], $sesi['token'], $sesi['last_login']);
          $this->sesi = 200;
        } else {
          session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Please Login</b></div>');
          $this->sesi = 400;
        }
      } else {
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Username is not registered!</b></div>');
        $this->sesi = 400;
      }
    }
    $cek = $this->AuthModel->get_user($user);
    if ($cek) {
      if (password_verify($password, $cek['password'])) {
        $token = base64_encode(random_bytes(32));
        $this->_loginProcess($cek['username'], $token, $cek['last_login']);
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

  protected function _loginProcess($username = false, $token = false, $last_login = false)
  {
    if (!$last_login) {
      $last_login = date("Y-m-d H:i:s", now('Asia/Jakarta'));
    }
    $data = [
      'username' => $username,
      'token' => $token,
      'last_login' => $last_login
    ];
    // dd($data);
    session()->setTempdata($data, 300);
    $ip_client = $_SERVER['REMOTE_ADDR'];
    if ($ip_client == "::1") {
      $ip_client = "localhost";
    }
    $data = array(
      'last_login' => $last_login,
      'ip_login' => $ip_client,
      'token' => $token
    );
    $this->AuthModel->get_user($username, $data);
  }

  //--------------------------------------------------------------------

}
