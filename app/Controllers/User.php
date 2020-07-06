<?php

namespace App\Controllers;

class User extends BaseController
{
  public function index()
  {
    return view('welcome_message');
  }

  public function create()
  {
    $data = [
      'title' => 'Form tambah data user'
    ];
    return view('user/create', $data);
  }
  //--------------------------------------------------------------------

}
