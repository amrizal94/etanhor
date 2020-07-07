<?php

namespace App\Controllers;


class Auth extends BaseController
{
  protected $form_validation;
  protected $data;
  public function __construct()
  {
    helper('form');
    helper('date');
    $this->form_validation = \Config\Services::validation();

    $this->data =  [
      'title' => 'Login',
      'body' => 'login-page'
    ];
  }
  public function index()
  {
    if ($this->status === 200) {

      return redirect()->to('/dashboard');
    }
    $data = [
      'group' => $this->Group
    ];

    $data = array_merge($data, $this->data);
    return view('user/login', $data);
  }

  public function auth()
  {
    if ($this->status === 200) {
      return redirect()->to('/dashboard');
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
      return view('user/login', $data);
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
        // dd(password_verify($sesi['token'], $cek));
        if (password_verify($sesi['token'], $cek)) {

          $data = [
            'id_polsek' => $sesi['id_polsek'],
            'id_polres' => $sesi['id_polres'],
            'level_user' => $sesi['level_user'],
            'nama_user' => $sesi['nama_user'],
            'username' => $sesi['username'],
            'token' => $sesi['token'],
            'last_login' => $sesi['last_login']
          ];

          $this->_loginProcess($data, $sesi['last_login']);
          $this->status = 200;
        } else {
          session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Please Login</b></div>');
          $this->status = 400;
        }
      } else {
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>Username is not registered!</b></div>');
        $this->status = 400;
      }
    } else {

      $cek = $this->AuthModel->get_user($user);
      if ($cek) {
        if (password_verify($password, $cek['password'])) {
          $token = base64_encode(random_bytes(32));
          $data = [
            'id_polsek' => $cek['id_polsek'],
            'id_polres' => $cek['id_polres'],
            'level_user' => $cek['level_user'],
            'nama_user' => $cek['nama_user'],
            'username' => $cek['username'],
            'token' => $token,
            'last_login' => $cek['last_login']
          ];
          $this->_loginProcess($data);
          return redirect()->to('/dashboard');
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
  }

  protected function _loginProcess($data = false, $last_login = false)
  {
    if (!$last_login) {
      $last_login = date("Y-m-d H:i:s", now('Asia/Jakarta'));
    }

    $username = $data['username'];
    $data = [
      'id_polsek' => $data['id_polsek'],
      'id_polres' => $data['id_polres'],
      'level_user' => $data['level_user'],
      'nama_user' => $data['nama_user'],
      'username' => $data['username'],
      'token' => $data['token'],
      'last_login' => $last_login
    ];
    session()->setTempdata($data, 300);
    $ip_client = $_SERVER['REMOTE_ADDR'];
    if ($ip_client == "::1") {
      $ip_client = "localhost";
    }
    $token = password_hash($data['token'], PASSWORD_DEFAULT);
    $data = array(
      'last_login' => $last_login,
      'ip_login' => $ip_client,
      'token' => $token
    );
    $this->AuthModel->get_user($username, $data);
  }

  public function logout()
  {
    session()->destroy();
    return redirect()->route('/');
  }
  //--------------------------------------------------------------------

}
