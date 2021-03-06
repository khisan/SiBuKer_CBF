<?php

namespace App\Controllers\Backend\Admin;

use App\Controllers\BaseController;
use App\Models\Auth_model;

class Auth_adm extends BaseController
{
  public function index()
  {
    return view('Auth/Admin/v_login');
  }
  public function login()
  {
    $model = new Auth_model;
    $table = 'tb_admin';
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $row = $model->get_data_login_adm($username, $table);
    if ($row == NULL) {
      session()->setFlashdata('pesan', 'errorU');
      return redirect()->to('/admin');
    }
    if (password_verify($password, $row->password)) {
      $data = array(
        'login' => TRUE,
        'username' => $row->username,
        'nama' => $row->nama,
      );
      session()->set($data);
      session()->setFlashdata('pesan', 'Berhasil Login');
      return redirect()->to('/admin/home');
    }
    session()->setFlashdata('pesan', 'errorP');
    return redirect()->to('/admin');
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    session()->setFlashData('pesan', 'Berhasil Logout');
    return redirect()->to('/admin');
  }
}
