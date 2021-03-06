<?php

namespace App\Controllers;

use App\Models\Lowongan_model;

class ListLowongan extends BaseController
{
  public function __construct()
  {
    $this->Lowongan_model = new Lowongan_model();
  }

  public function index()
  {
    \Config\Services::pager();
    $data = [
      'isi' => 'Frontend/v_list_lowongan',
      'lowongan'  => $this->Lowongan_model->join('tb_perusahaan', 'tb_perusahaan.id_perusahaan = tb_lowongan.id_perusahaan')->paginate(4),
      'pager' => $this->Lowongan_model->pager
    ];
    return view('Frontend/layout/v_wrapper', $data);
  }

  public function cari()
  {
    \Config\Services::pager();
    $keyword = $this->request->getPost('keyword');
    $data = [
      'isi' => 'Frontend/v_cari_lowongan',
      'cari_lowongan' => $this->Lowongan_model->cari($keyword),
      // 'cari_lowongan'  => $this->Lowongan_model->paginate(4),
      'pager' => $this->Lowongan_model->pager
    ];
    return view('Frontend/layout/v_wrapper', $data);
  }

  public function detail($id_lowongan)
  {
    $data = [
      'isi' => 'Frontend/v_detail_lowongan',
      'detail_lowongan' => $this->Lowongan_model->detailLowongan($id_lowongan),
    ];
    return view('Frontend/layout/v_wrapper', $data);
  }
}
