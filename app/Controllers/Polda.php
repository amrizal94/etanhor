<?php

namespace App\Controllers;

use App\Models\PoldaModel;


class Polda extends BaseController
{
  protected $data;
  protected $PoldaModel;
  public function __construct()
  {
    // helper('form');
    // $this->validasi = \Config\Services::validation();
    $this->PoldaModel = new PoldaModel();

    $this->data =  [
      'title' => 'Polda',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor',
      'mtitleAdd' => 'Form tambah Polda',
      'mtitleEdit' => 'Form edit Polda'

    ];
  }
  public function index()
  {

    if ($this->sesi === 400) {
      return redirect()->route('/');
    }
    $data = [
      'group' => $this->Group,
      'data' => $this->PoldaModel->findAll()
    ];
    $data = array_merge($data, $this->data);
    return view('polda/list', $data);
  }


  public function save()
  {
    if ($this->sesi === 400) {
      return redirect()->to('/polda');
    }

    $polda  = htmlspecialchars($this->request->getVar('polda'), true);
    $id  = htmlspecialchars($this->request->getVar('id_polda'), true);
    $polda = strtoupper($polda);
    $pisah = explode("POLDA", $polda);
    if (!isset($pisah[1])) {
      $polda = strtoupper('polda' . ' ' . $polda);
    }



    if ($id) {
      $poldalama = $this->PoldaModel->getPolda($id);
      if (isset($poldalama)) {
        if ($poldalama['nama_polda'] == $polda) {
          $rule_polda = 'required';
        } else {
          $rule_polda = 'required|is_unique[d_polda.nama_polda]';
        }
      }

      if (!$this->validate([
        'polda' => $rule_polda
      ])) {
        $validasi = \Config\Services::validation();
        $validasi = $validasi->getError('polda');
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>' . $validasi . '</b></div>');
        return redirect()->to('/polda');
      }
      $this->PoldaModel->save([
        'id_polda' => $id,
        'nama_polda' => $polda
      ]);
      session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully edited!</b></div>');
      return redirect()->to('/polda');
    }

    $this->PoldaModel->save([
      'nama_polda' => $polda
    ]);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully added!</b></div>');
    return redirect()->to('/polda');
  }

  public function delete($id)
  {
    if ($this->sesi === 400) {
      return redirect()->route('/');
    }
    $this->PoldaModel->delete($id);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully deleted!</b></div>');
    return redirect()->to('/polda');
  }

  //--------------------------------------------------------------------

}
