<?php

namespace App\Controllers;

class Auth_adm extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function index()
  {
    return view('auth/admin/v_auth');
  }

  public function register()
  {
  }
}