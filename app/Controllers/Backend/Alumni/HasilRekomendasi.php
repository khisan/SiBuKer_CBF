<?php

namespace App\Controllers\Backend\Alumni;

use App\Controllers\BaseController;
use App\Models\Alumni_model;
use App\Models\Lowongan_model;
use App\Models\Sub_Kriteria_Lowongan_model;
use App\Models\Kriteria_Model;

class HasilRekomendasi extends BaseController
{
  public function __construct()
  {
    $this->Sub_Kriteria_Lowongan_model = new Sub_Kriteria_Lowongan_model();
    $this->Alumni_Model = new Alumni_model();
    $this->Lowongan_model = new Lowongan_model();
    $this->Kriteria_Model = new Kriteria_Model();
  }

  //Pembagi 
  public function pembagi()
  {
    $jmlKriteria = $this->Kriteria_Model->jmlKriteria();
    $getNilai = $this->Lowongan_model->getNilai();
    $no = 1;
    while ($row = $getNilai->getUnbufferedRow()) {
      $matrikNormalisasi[$no - 1] = array($row->umur, $row->kualifikasi_pendidikan, $row->ipk, $row->jenis_kelamin, $row->pengalaman_kerja, $row->jurusan);
      $no++;
    }
    for ($i = 0; $i < $jmlKriteria; $i++) {
      $pangkatdua[$i] = 0;
      for ($j = 0; $j < sizeof($matrikNormalisasi); $j++) {
        $pangkatdua[$i] = $pangkatdua[$i] + pow($matrikNormalisasi[$j][$i], 2);
      }
      $pembagi[$i] = sqrt($pangkatdua[$i]);
    }
    return $pembagi;
  }

  //Matrik Normalisasi
  public function matrikNormalisasi()
  {
    $pembagi = $this->pembagi();
    $getNilai = $this->Lowongan_model->getNilai();
    $no = 1;
    while ($row = $getNilai->getUnbufferedRow()) {
      $matrikNormalisasi[$no - 1] = array(
        $row->umur / $pembagi[0],
        $row->kualifikasi_pendidikan / $pembagi[1],
        $row->ipk / $pembagi[2],
        $row->jenis_kelamin / $pembagi[3],
        $row->pengalaman_kerja / $pembagi[4],
        $row->jurusan / $pembagi[5]
      );
      $no++;
    }
    return $matrikNormalisasi;
  }

  //Normalisasi Bobot
  public function normalisasiBobot()
  {
    $matrikNormalisasi = $this->matrikNormalisasi();
    $lowongan = $this->Lowongan_model->getNilai();
    $sesiNilaiAlumni = session()->get();
    $umur = $sesiNilaiAlumni['umur'];
    $kualifikasi_pendidikan = $sesiNilaiAlumni['kualifikasi_pendidikan'];
    $ipk = $sesiNilaiAlumni['ipk'];
    $jenis_kelamin = $sesiNilaiAlumni['jenis_kelamin'];
    $pengalaman_kerja = $sesiNilaiAlumni['pengalaman_kerja'];
    $jurusan = $sesiNilaiAlumni['jurusan'];
    $no = 1;
    while ($lowongan->getUnbufferedRow()) {
      $normalisasiBobot[$no - 1] = array(
        $matrikNormalisasi[$no - 1][0] * $umur,
        $matrikNormalisasi[$no - 1][1] * $kualifikasi_pendidikan,
        $matrikNormalisasi[$no - 1][2] * $ipk,
        $matrikNormalisasi[$no - 1][3] * $jenis_kelamin,
        $matrikNormalisasi[$no - 1][4] * $pengalaman_kerja,
        $matrikNormalisasi[$no - 1][5] * $jurusan
      );
      $no++;
    }
    return $normalisasiBobot;
  }

  public function index()
  {
    $table = 'tb_alumni';
    $sesiAlumni = session()->get();
    $id_alumni = $sesiAlumni['id_alumni'];
    $data = [
      'title'   => 'Hasil Rekomendasi Lowongan',
      'alumni'  => $this->Alumni_Model->get_alumni_by_id($id_alumni, $table),
      'lowongan'  => $this->Lowongan_model->allData(),
      'tabel_pembagi' => $this->pembagi(),
      'matrik_normalisasi' => $this->matrikNormalisasi(),
      'normalisasi_bobot' => $this->normalisasiBobot(),
      'isi'     => 'Backend/Alumni/v_hasil_rekomendasi'
    ];
    return view('Backend/Alumni/layout/v_wrapper', $data);
  }
}
