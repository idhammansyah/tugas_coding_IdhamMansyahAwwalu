<?php

namespace App\Controllers; //arahkan ke folder module Administrator

use App\Controllers\BaseController; //arahkan ke BaseController

class Login extends BaseController {

  protected $m_useraccess;

  public function __construct() {
    $this->m_useraccess = model('App\Models\Administrator\Useraccess_model'); //memanggil model
  }

  public function index() {
    return view('v_administrator/backend/login');
  }

  public function verifikasiuser() {
    $param = $this->request->getPost();
    
    $username = $param['username'];
    $password = md5($param['password']);
    $checkuseraccess = $this->m_useraccess->checkuseraccess($username, $password);

    $valid = false;
    $message = "Login gagal, silakan cek username dan password";
    if ($checkuseraccess) {           
      $this->sessiondata->set('userdata', array(
        "is_login" => true,
        "username" => $username,
      ));

      return $this->response->setJSON(array(
        "valid" => true,
        "message" => "Login berhasil",
      ));
    } else {
      // Kirim pesan error jika login gagal
      return $this->response->setJSON(array(
                    "valid" => $valid,
                    "message" => $message,
        ));
    }
  }

  public function logout() {
      // Hapus session dan arahkan ke halaman login
      $this->sessiondata->destroy();
      // Redirect ke halaman login
       return redirect()->to(base_url('login'));
  }

}
