<?php

namespace App\Controllers;

class Home extends BaseController
{
  public function __construct()
  {
    $this->users = model('App\Models\Authentication\User_Model');
    $this->log_activity = model('App\Models\Authentication\Log_Model');
    $this->token = model('App\Models\Authentication\Tokenize_Model');
    $this->session = \Config\Services::session();
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    // return view('home/index');
  }

  public function login_page()
  {
    $data = [
      'title'       => "Login Page",
      'company'     => $this->log_activity->getCompany(),
      'dept'        => $this->log_activity->getDepartment(),
      'validation'  => $this->validation,
    ];

    return view('home/index', $data);
  }

  public function checkEmail()
  {
    $email = $this->request->getVar('email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode(['status' => 'error', 'message' => 'Email not valid']);
      return;
    }

    if ($this->users->isEmailRegistered($email)) {
      echo json_encode(['status' => 'error', 'message' => 'Email is already use!']);
    } else {
      echo json_encode(['status' => 'success', 'message' => 'Email is free!']);
    }
  }

  public function checkUsername()
  {
    $username = $this->request->getVar('username');
    
    if ($this->users->isusernameRegistered($username)) {
      echo json_encode(['status' => 'error', 'message' => 'Username is already use!']);
    } else {
      echo json_encode(['status' => 'success', 'message' => 'Username is free!']);
    }
  }

  public function create_account()
  {
    $input = [
      'email'         => $this->request->getVar('email'),
      'username'      => $this->request->getVar('username'),
      'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
      'gender'        => $this->request->getVar('gender'),
      'role_id'       => 2,
      'status_akun'   => 0,
      // 'company_id'    => $this->request->getVar('company'),
      // 'department_id' => $this->request->getVar('department'),
      'status'        => 'activate account',
      'created_at'    => date('Y-m-d H:i:s')
    ];

    $this->users->save($input);

    $token = bin2hex(random_bytes(16));
    $tokenize = [
      'token'         => $token,
      'email'         => $input['email'],
      'status'        => 0,
      'informasi'     => 'Aktivasi akun baru',
      'created_at'    => date('Y-m-d H:i:s')
    ];

    $this->token->save($tokenize);

    $email = \Config\Services::email();
    $email->setTo($input['email']);
    $email->setSubject('Aktivasi Akun');
    
    $email->setMessage(send_email_activation($input['email'], $tokenize['token'], $tokenize['email']));
    $email->send();

    $data = ['status' => 'Anda berhasil registrasi. Silahkan cek email anda untuk mengaktifkan akun anda.'];
    
    return $this->response->setJSON($data);
  }

  public function aktifkan_akun($token = null, $email = null)
  {
    $getToken = $this->token->checkToken($token, $email);
    if($getToken > 0) {
      $activateToken = $this->token->activateToken($token, $email);
      $activate_user = $this->token->activateUser($email);
      if($activateToken == true && $activate_user == true) 
       {
          // echo "<script>alert('Akun kamu berhasil aktif!');document.location='".site_url('login')."'</script>";
          echo "<script>document.location='".site_url('/')."'</script>";
          session()->setFlashdata('message', 'Akun berhasil di daftarkan. Silahkan login.');
       } else
       {
          // echo "<script>alert('Link anda salah');document.location='".route_to('login')."'</script>";
          echo "<script>document.location='".site_url('/')."'</script>";
          session()->setFlashdata('error', 'Link kamu salah!');
       }
    } else {
      echo "<script>alert('Token tidak ditemukan atau anda telah melakukan aktivasi akun!');document.location='".site_url('/')."'</script>";
      session()->setFlashdata('error', 'Token tidak ditemukan atau anda telah melakukan aktivasi');
    }
  }

  public function login()
  {
    $input = [
      'username'      => $this->request->getVar('username'),
      'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT),
      'isLogin'       => 1
    ];
    
    // $users = $this->users->where('username', $input['username'])->orWhere('email', $input['username'])->first();
    $users = $this->users->check_account($input['username'], $input['username']);

    if(! empty($users))
    {
      if($users['status_akun'] == "1" && $users['status'] == "verified")
      {
        if($users && password_verify($this->request->getVar('password_hash'), $users['password_hash']))
        {
          
          $check_session = session()->get('user_data');

          $log_activity = [
            'id_user'   => $users['id_user'],
            'activity_user'   => $users['nama_lengkap'] . ' melakukan login pada ' . date('Y-m-d H:i:s') . ' dan login menggunakan device ' .$this->request->getUserAgent(),
            'created'    => date('Y-m-d H:i:s')
          ];
      
          $this->log_activity->save($log_activity);

          $update = ['isLogin' => 1, 'last_login' => date('Y-m-d H:i:s')];
          $this->users->update($check_session['id_user'], $update);
          
          if($check_session['role_id'] == 1)
          {
            session()->setFlashdata('message', 'Welcome, ' . $check_session['username'] . '.');

            return redirect()->route('superadmin_dashboard');
          } 
          else if($check_session['role_id'] == 58) 
          {
            session()->setFlashdata('message', 'Welcome, ' . $check_session['username'] . '.');

            return redirect()->route('58');
          }
        } 
        else if($users && !password_verify($this->request->getVar('password_hash'), $users['password_hash']))
        {
          session()->setFlashdata('error', 'Username atau password salah!');
          return redirect()->back();
        }
      } else {
        $token = bin2hex(random_bytes(16));
        $tokenize = [
          'token'         => $token,
          'email'         => $users['email'],
          'status'        => 0,
          'informasi'     => 'Re-Aktivasi ulang akun',
          'created_at'    => date('Y-m-d H:i:s')
        ];

        $this->token->save($tokenize);

        session()->setFlashdata('error', 
          'Akun kamu belum diaktifkan. 
            <a href="'.base_url('aktivasi-ulang').'/'.$users['email'].'/'.$tokenize['token'].'">
              Silahkan aktifkan disini.
            </a>
        ');
        return redirect()->to(base_url('/'));
      }
    } 
    else
    {
      session()->setFlashdata('error', 'Tidak ditemukan akun!');
      return redirect()->back()->with('error', 'Akun tidak ditemukan!');
    }
  }

  public function aktivasi_kembali($emails=null, $token=null)
  {
    $tokenize = [
      'status'  => 1,
    ];
    $this->token->update($token, $tokenize);
  
    $email = \Config\Services::email();
    $email->setTo($emails);
    $email->setSubject('Aktivasi Ulang Akun');
    
    $email->setMessage('
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <title>Aktivasi Akun Kamu</title>
        <style>
          /* Ganti warna latar belakang dan warna teks sesuai keinginan Anda */
          body {
            background-color: #f8f8f8;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            text-align:justify;
          }
          /* Ganti warna latar belakang dan warna teks tombol sesuai keinginan Anda */
          button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 12px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
          }
          p, a, b {
            font-size:14pt;
            text-align: justify;
            text-decoration:none;
          }
        </style>
      </head>
      <body>
        <h3>Halo, '.$emails.'. Aktifkan kembali akun kamu.</h3>
        <p>Email ini dikirim karena anda melakukan request aktivasi ulang akun kamu. Silahkan klik tombol aktifkan dibawah ini untuk mengaktifkan akun kamu.</p><br>
        
        <a href=" '.base_url('reactivate-account-email/'. $token. '/' . $emails).'">
          Klik disini untuk aktifkan akun
        </a>
        <br><br>

        Jika kamu merasa tidak mendaftarkan diri di website kami, silahkan hapus email ini. <br><br>

        Cheers, <br><br>
        <b>Big Apps</b>
      </body>
    </html>
    
    ');
    $sending = $email->send();

    if($sending)
    {
      session()->setFlashdata('message', 'Silahkan cek email kamu.');
      return redirect()->to('/');
    } else{
      session()->setFlashdata('error', 'Gagal mengirim email. Silahkan ajukan kembali.');
      return redirect()->to('/');
    }

  }

  public function aktivasiulang($token, $email)
  {
    $getToken = $this->token->checkTokenReactivate($token, $email);
    if($getToken > 0)
    {
      $activateToken = $this->token->activateTokenReactivate($token, $email);
      $activate_user = $this->token->activateUser($email);
      if($activateToken == true && $activate_user == true) 
      {
        // echo "<script>alert('Akun kamu berhasil aktif!');document.location='".site_url('login')."'</script>";
        echo "<script>document.location='".site_url('/')."'</script>";
        session()->setFlashdata('message', 'Akun diaktifkan kembali. Silahkan login.');
      } else
      {
        // echo "<script>alert('Link anda salah');document.location='".route_to('login')."'</script>";
        echo "<script>document.location='".site_url('/')."'</script>";
          session()->setFlashdata('error', 'Link kamu salah!');
      }
    } else {
      echo "<script>alert('Token tidak ditemukan atau anda telah melakukan aktivasi akun!');document.location='".site_url('/')."'</script>";
      session()->setFlashdata('error', 'Token tidak ditemukan atau anda telah melakukan aktivasi');
    }
  }

  public function forgot_password()
  {
    $cari_email = $this->request->getVar('email');
    $user_checking = $this->users->where('email', $cari_email)->first();
    if($user_checking)
    {
      $token = bin2hex(random_bytes(16));

      $input = [
        'reset_hash'  => $token,
        'reset_at'    => date('Y-m-d H:i:s')
      ];

      $this->users->update($user_checking['id_user'], $input);
      $email = \Config\Services::email();
      $email->setTo($cari_email);
      $email->setSubject('Ubah Password Kamu');
      
      $email->setMessage('
        <!DOCTYPE html>
        <html>
          <head>
            <meta charset="UTF-8">
            <title>Ubah Password Anda</title>
            <style>
              /* Ganti warna latar belakang dan warna teks sesuai keinginan Anda */
              body {
                background-color: #f8f8f8;
                color: #333;
                font-family: Arial, sans-serif;
                font-size: 16px;
                line-height: 1.5;
                text-align:justify;
              }
              /* Ganti warna latar belakang dan warna teks tombol sesuai keinginan Anda */
              button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 12px 24px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 4px;
              }
            </style>
          </head>
          <body>
            <h1>Ubah Password Anda</h1>
            <p>
              Email ini dikirim karena kamu meminta untuk mengubah password anda yang lupa. Silahkan <a href=" '. site_url('ubah-password/'. $token). '">
              <b>klik disini untuk mengubah password anda</b></a> dan ikuti untuk mengubah password. 
            </p><br><br>
            
            Cheers,<br><br>
            <b>Big Apps</b>
          </body>
        </html>
      ');

      $email->send();
      $data = ['status' => 'Silahkan cek email anda.'];
      return $this->response->setJSON($data);
    } else if(is_null($user_checking)) {
      $data = ['status' => 'Email tidak ditemukan!'];
      return $this->response->setJSON($data);
    } else {
      $data = ['status' => 'Gagal mengirim email. Silahkan coba lagi.'];
      return $this->response->setJSON($data);
    }
  }

  public function v_forgot_password($token)
  {
    $checking = $this->users->checking_token($token);
    if(!empty($checking))
    {
      $data = [
        'title'       => 'Change your password',
        'validation'  => \Config\Services::validation(),
        'getAccount'  => $checking
      ];

      return view('home/forgot_password', $data);
    } else
    {
      echo "<script>document.location='".site_url('/')."'</script>";
      session()->setFlashdata('error', 'Token is expired, please resend new form forgot password!');
    }
  }

  public function save_forgot_password($id)
  {
    $input = [
      'id'            => $this->request->getVar('uniques'),
      'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT),
      'reset_hash'    => '',
      'reset_at'      => date('Y-m-d H:i:s')
    ];

    if($this->users->update($id, $input)) {
      echo "<script>document.location='".base_url('login')."'</script>";
      session()->setFlashdata('message', 'Password success changed.');
    } else {
      echo "<script>document.location='".base_url('login')."'</script>";
      session()->setFlashdata('error', 'Please try again!');
    }
  }

  public function logout()
  {
    $users = $this->session->get('user_data');
    $log_activity = [
      'id_user'   => $users['id_user'],
      'activity_user'   => $users['username'] . ' melakukan logout pada ' . date('Y-m-d H:i:s'),
      'created'    => date('Y-m-d H:i:s')
    ];

    $this->log_activity->save($log_activity);

    $update = ['isLogin' => 0, 'last_login' => date('Y-m-d H:i:s')];
    $this->users->update($users['id_user'], $update);

    session()->destroy();
    session()->setFlashdata('message', 'Anda sudah logout.');
    return redirect()->route('/');
  }
}
