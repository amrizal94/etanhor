<?php

namespace App\Controllers;

use App\Models\PolresModel;
use App\Models\PolsekModel;

class Polsek extends BaseController
{
  protected $data;
  protected $PolresModel;
  protected $PolsekModel;

  public function __construct()
  {
    // helper('form');
    // $this->validasi = \Config\Services::validation();
    $this->PolresModel = new PolresModel();
    $this->PolsekModel = new PolsekModel();

    $this->data =  [
      'title' => 'Polsek',
      'body' => 'sidebar-mini',
      'project' => 'Etanhor',
      'mtitleAdd' => 'Form tambah Polsek',
      'mtitleEdit' => 'Form edit Polsek'

    ];
  }
  public function index()
  {

    if ($this->status === 400) {

      return redirect()->to('/');
    }
    $data = [
      'group' => $this->Group,
      'data' => $this->PolsekModel->getPolsek(),
      'polres' => $this->PolresModel->getPolres()
    ];
    $data = array_merge($data, $this->data);
    return view('polsek/list', $data);
  }


  public function save()
  {
    if ($this->status === 400) {
      return redirect()->to('/polsek');
    }
    // dd($this->request->getVar());
    $polsek  = htmlspecialchars($this->request->getVar('polsek'), true);
    $id  = htmlspecialchars($this->request->getVar('id_polsek'), true);
    $id_polres  = htmlspecialchars($this->request->getVar('id_polres'), true);
    $slug_polres = $this->PolresModel->getPolres($id_polres);
    if ($id_polres) {
      $slug_polres = $slug_polres['slug_polres'];
    }

    $polsek = strtoupper($polsek);
    $pisah = explode("POLSEK", $polsek);
    if (!isset($pisah[1])) {
      $polsek = strtoupper('polsek' . ' ' . $polsek);
    }

    $slug_polsek = url_title($polsek, '-', true);


    if ($id) {
      $polseklama = $this->PolsekModel->getPolsek($id);
      if (isset($polseklama)) {
        if ($polseklama['nama_polsek'] == $polsek) {
          $rule_polsek = 'required';
        } else {
          $rule_polsek = 'required|is_unique[d_polsek.nama_polsek]';
        }
      }

      if (!$this->validate([
        'polsek' => $rule_polsek
      ])) {
        $validasi = \Config\Services::validation();
        $validasi = $validasi->getError('polsek');
        session()->setFlashdata('message', '<div class ="alert alert-danger" role="alert"><b>' . $validasi . '</b></div>');
        return redirect()->to('/polsek');
      }
      $data = [
        'nama_polsek' => $polsek,
        'slug_polsek' => $slug_polsek
      ];
      $this->PolsekModel->update($id, $data);
      session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully edited!</b></div>');
      return redirect()->to('/polsek');
    }



    $this->PolsekModel->save([
      'id_polres' => $id_polres,
      'nama_polsek' => $polsek,
      'slug_polres' => $slug_polres,
      'slug_polsek' => $slug_polsek
    ]);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully added!</b></div>');
    return redirect()->to('/polsek');
  }

  public function delete($id)
  {
    if ($this->status === 400) {
      return redirect()->route('/');
    }
    $this->PolsekModel->delete($id);
    session()->setFlashdata('message', '<div class ="alert alert-success" role="alert"><b>successfully deleted!</b></div>');
    return redirect()->to('/polsek');
  }

  //--------------------------------------------------------------------

}
