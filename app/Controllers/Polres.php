<?php

namespace App\Controllers;

use App\Models\PoldaModel;
use App\Models\PolresModel;

class Polres extends BaseController
{
  protected $data;
  protected $PoldaModel;
  protected $PolresModel;

  public function __construct()
  {
    // helper('form');
    // $this->validasi = \Config\Services::validation();
    $this->PoldaModel = new PoldaModel();
    $this->PolresModel = new PolresModel();

    $this->data =  [
      'title' => 'Polres',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor',
      'mtitleAdd' => 'Form tambah Polres',
      'mtitleEdit' => 'Form edit Polres'

    ];
  }
  public function index()
  {

    if ($this->status === 400) {

      return redirect()->to('/');
    }
    $data = [
      'group' => $this->Group,
      'data' => $this->PolresModel->getPolres(),
      'polda' => $this->PoldaModel->getPolda()
    ];
    $data = array_merge($data, $this->data);
    return view('polres/list', $data);
  }


  public function save()
  {
    if ($this->status === 400) {
      return redirect()->to('/polres');
    }
    // dd($this->request->getVar());
    $polres  = htmlspecialchars($this->request->getVar('polres'), true);
    $id  = htmlspecialchars($this->request->getVar('id_polres'), true);
    $id_polda  = htmlspecialchars($this->request->getVar('id_polda'), true);
    $slug_polda = $this->PoldaModel->getPolda($id_polda);
    $slug_polda = $slug_polda['slug_polda'];
    // dd($slug_polda);
    $polres = strtoupper($polres);
    $pisah = explode("POLRES", $polres);
    if (!isset($pisah[1])) {
      $polres = strtoupper('polres' . ' ' . $polres);
    }
    $slug_polres = url_title($polres, '-', true);


    if ($id) {
      $polreslama = $this->PolresModel->getPolres($id);
      if (isset($polreslama)) {
        if ($polreslama['nama_polres'] == $polres) {
          $rule_polres = 'required';
        } else {
          $rule_polres = 'required|is_unique[d_polres.nama_polres]';
        }
      }

      if (!$this->validate([
        'polres' => $rule_polres
      ])) {
        $validasi = \Config\Services::validation();
        $validasi = $validasi->getError('polres');
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>' . $validasi . '</b></div>');
        return redirect()->to('/polres');
      }
      $data = [
        'nama_polres' => $polres,
        'slug_polres' => $slug_polres
      ];
      $this->PolresModel->update($id, $data);
      session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully edited!</b></div>');
      return redirect()->to('/polres');
    }



    $this->PolresModel->save([
      'id_polda' => $id_polda,
      'nama_polres' => $polres,
      'slug_polda' => $slug_polda,
      'slug_polres' => $slug_polres
    ]);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully added!</b></div>');
    return redirect()->to('/polres');
  }

  public function delete($id)
  {
    if ($this->status === 400) {
      return redirect()->route('/');
    }
    $this->PolresModel->delete($id);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully deleted!</b></div>');
    return redirect()->to('/polres');
  }

  //--------------------------------------------------------------------

}
