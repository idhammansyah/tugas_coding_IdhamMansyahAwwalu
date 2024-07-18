<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Superadmin_action_Controller extends BaseController
{

  public function __construct()
  {
    $this->users = model('App\Models\Authentication\User_Model');
    $this->log_activity = model('App\Models\Authentication\Log_Model');
    $this->menu_category = model('App\Models\Authentication\Menu_Category_Model');
    $this->menu = model('App\Models\Authentication\Menu_Model');
    $this->sub_menu = model('App\Models\Authentication\SubMenu_Model');
    $this->role = model('App\Models\Authentication\Role_Model');
    $this->calendar_events = model('App\Models\Events\Calendar_Model');
    $this->materials = model('App\Models\Materi\Materi_Model');

    $this->company = model('App\Models\Jobs\Company_Model');
    $this->department = model('App\Models\Jobs\Department_Model');
    $this->position = model('App\Models\Jobs\Position_Model');
    $this->level = model('App\Models\Jobs\Level_Model');
    $this->location = model('App\Models\Jobs\Location_Model');
    $this->contract = model('App\Models\Jobs\Contract_Model');
    $this->jobs = model('App\Models\Jobs\Job_Model');

    $this->session = \Config\Services::session();
    $this->validation = \Config\Services::validation();

    $this->items_data = model('App\Models\Datastock\ItemsModel');
    $this->items_type = model('App\Models\Datastock\ItemsTypeModel');
    $this->items_transaction = model('App\Models\Datastock\ItemTransactionModel');
  }

  public function load_menu()
  {
    $category_id = $this->request->getPost('categories');
    
    $menus = $this->menu->getMenu($category_id);

    // Kirim submenu sebagai respons JSON
    return $this->response->setJSON($menus, 200);
  }

  public function load_sub_menu()
  {
    $menuId = $this->request->getPost('menu');
    
    $submenus = $this->sub_menu->getSubmenu($menuId);

    // Kirim submenu sebagai respons JSON
    return $this->response->setJSON($submenus, 200);
  }

  public function move_menu()
  {
    // get menu order and sub menu order from ajax
    $menu_order = $this->request->getPost('menu_order');
    if($menu_order)
    {
      $cobain = $this->menu->updateMenuOrder($menu_order);
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Urutan berhasil di ubah";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    } else {
      $response = "<i class='bi bi-x'></i>&nbsp; Urutan gagal di ubah";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function add_new_menu_categories()
  {
    $request = $this->request->getPost();
    $input = [
      'nama_menu_category' => $request['menu_category_name'],
      'deskripsi'     => $request['desc'],
      'is_active' => $request['is_active'],
      'urutan'    => $request['urutan'],
      'id_role'   => $request['role_name']
    ];
    $saves = $this->menu_category->save($input);
    if($saves) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function add_new_menu()
  {
    $request = $this->request->getPost();
    $input = [
      'menu_name' => $request['menu_name'],
      'icons'     => $request['icons'],
      'url_link'  => $request['url_link'],
      'posisi'    => $request['position_menu'],
      'id_role'   => $request['role_name'],
      'is_active' => $request['is_active'],
      'id_menu_category'  => $request['categories'],
      'urutan'    => $request['queue']
    ];
    $saves = $this->menu->save($input);
    if($saves) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }
  
  public function add_new_submenu()
  {
    $request = $this->request->getPost();
    $input = [
      'menu_id'       => $request['menu_id'],
      'id_role'       => $request['role_name'],
      'url_link'      => $request['url_link'],
      'sub_menu_name' => $request['sub_menu_name'],
      'icons'         => $request['icons'],
      'is_active'     => $request['is_active'],
      'urutan'        => $request['queue'],
    ];
    $saves = $this->sub_menu->save($input);
    if($saves) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function load_events_calendar()
  {
    $getCalendar = $this->calendar_events->getDate();
		if (empty($getCalendar)) {
			return $this->response->setJSON($getCalendar, 200);
		} else {
			return $this->response->setJSON($getCalendar, 200);
		}
  }

  public function save_event_calendar()
	{
    $request = $this->request->getPost();
    $input = [
      'title_events' => $request['title'],
      'start_date'   => $request['date'],
      'notes_events' => $request['notes'],
      'created_by'   => $this->session->get('user_data')['username'],
      'created_at'   => date('Y-m-d H:i:s'),
      'status_event' => 1
    ];
    $save = $this->calendar_events->save($input);
		if($save) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
	}

  public function update_event_calendar($id)
  {
    $input= [
      'title_events'  => $this->request->getVar('title'),
      'start_date'    => $this->request->getVar('date_events'),
      'notes_events'  => $this->request->getVar('notes'),
      'updated_by'    => session()->get('user_data')['username'],
      'updated_at'    => date('Y-m-d H:i:s')
    ];
    $updates = $this->calendar_events->update($id, $input);
    if($updates)
    {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Update success!";
      return redirect()->route('4/view-calendar')->with('message', $response);
    } else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      return redirect()->route($_SERVER['HTTP_REFERER'])->with('error', $response);
    }
  }

  public function delete_event_calendar($id)
  {
    $updates = $this->calendar_events->deleteData($id);
    if($updates == 1) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Delete success!";
      $data = ['status' => $response];
      return redirect()->route('4/view-calendar')->with('message', $response);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Delete failed!";
      $data = ['status' => $response];
      return redirect()->route('4/view-calendar')->with('error', $response);
    }
  }

  public function datatables_users_dashboard()
  {
    $requestData = $this->request->getPost();

    $data = [];
    $data['draw'] = $requestData['draw'];
    $data['recordsTotal'] = $this->users->countAllTotalUser();
    $data['recordsFiltered'] = $data['recordsTotal'];
    $data['data'] = $this->users->getAllUsers($requestData);

    return $this->response->setJSON($data);
  }

  public function save_learning_material()
  {
    $file_materi = $this->request->getFile('file_upload');
    $name_of_files = $file_materi->getName();

    $input = [
      'judul'             => $this->request->getVar('title'),
      'konten'            => $this->request->getVar('contents'),
      'file_materi'       => $name_of_files,
      'link_materi'       => $this->request->getVar('link'),
      'id_pengisi_materi' => $this->request->getVar('pemateri'),
      'tgl_posting'       => date('Y-m-d H:i:s'),
      'posted_by'         => session()->get('user_data')['username'],
      'publish'           => 0,
      'views'             => 0,
      'delete'            => 0,
    ];

    $file_materi->move('upload/materi', $name_of_files);

    $upload_materi = $this->materials->save($input);
    if($upload_materi)
    {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Upload success!";
      return redirect()->route('view-learning-materials')->with('message', $response);
    } 
    else
    {
      $response = "<i class='bi bi-x'></i>&nbsp; Upload Failed!";
      return redirect()->route('view-learning-materials')->with('error', $response);
    }

  }

  public function publishMateri()
  {
    // Menerima data-materi dari permintaan POST
    $dataMateri = $this->request->getPost('data-materi');

    $update = [
      'publish' => 1, 
      'publish_date' => date('Y-m-d H:i:s'),
      'publish_by'   => session()->get('user_data')['nama_lengkap'] 
    ];

    $publish = $this->materials->update($dataMateri, $update);
    if ($publish)
    {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Success publish!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    } else {
      $response = "<i class='bi bi-x'></i>&nbsp; Failed publish!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function closeMateri()
  {
    // Menerima data-materi dari permintaan POST
    $dataMateri = $this->request->getPost('data-materi');

    $update = [
      'publish'      => 0, 
      'publish_date' => date('Y-m-d H:i:s'),
      'publish_by'   => session()->get('user_data')['nama_lengkap'] 
    ];
    
    $publish = $this->materials->update($dataMateri, $update);
    if ($publish)
    {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Success close publish!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    } else {
      $response = "<i class='bi bi-x'></i>&nbsp; Failed close publish!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function deleteMateri()
  {
    // Menerima data-materi dari permintaan POST
    $dataMateri = $this->request->getPost('data-materi');

    $update = [
      'publish'      => 0, 
      'publish_date' => '',
      'publish_by'   => '', 
      'updated_by'   => session()->get('user_data')['nama_lengkap'],
      'tgl_update'   => date('Y-m-d H:i:s'),
      'delete'       => 1
    ];
    
    $publish = $this->materials->update($dataMateri, $update);
    if ($publish)
    {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Success delete learning material!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    } else {
      $response = "<i class='bi bi-x'></i>&nbsp; Failed delete learning material!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
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
    $request = $this->request->getPost();
    $input = [
      'email'           => $request['email'],
      'username'        => $request['username'],
      'nama_lengkap'    => $request['nama_lengkap'],
      'role_id'         => $request['role'],
      'company_id'      => $request['company'],
      'department_id'   => $request['department'],
      'gender'          => $request['gender'],
      'status_akun'     => $request['status_akun'],
      'status'          => $request['status_akun'] == 1 ? 'verified' : 'activate account',
      'password_hash'   => password_hash($request['password'], PASSWORD_DEFAULT),
      'created_at'      => date('Y-m-d H:i:s'),
    ];

    $tambah_akun = $this->users->save($input);
    if($tambah_akun) {
      if($request['status_akun'] == 0) 
      {
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
        $sending_email = $email->send();
        if($sending_email) {
          $response = "<i class='bi bi-check2-circle'></i>&nbsp; Success add account, check your email";
          $data = ['status' => $response];
          
          return $this->response->setJSON($data);
        } else {
          $response = "<i class='bi bi-x'></i>&nbsp; Failed send email!";
          $data = ['status' => $response];
          
          return $this->response->setJSON($data);
        }
      }

      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Success Add Account!";
      $data = ['status' => $response];
      
      return $this->response->setJSON($data);
    } else {
      $response = "<i class='bi bi-x'></i>&nbsp; Failed Add Account!";
      $data = ['status' => $response];
      
      return $this->response->setJSON($data);
    }
  }

  public function posting_jobs()
  {
    $opening_at = $this->request->getVar('opening');
    $formatted_opening = date('Y-m-d', strtotime($opening_at));

    $closed_at = $this->request->getVar('closed');
    $formatted_closed = date('Y-m-d', strtotime($closed_at));

    $input = [
      'uid_hash'      => bin2hex(random_bytes(16)),
      'id_company'    => $this->request->getVar('company'),
      'id_department' => $this->request->getVar('department'),
      'id_level'      => $this->request->getVar('level'),
      'id_position'   => $this->request->getVar('position'),
      'id_contracts'   => $this->request->getVar('contract'),
      'id_location'   => $this->request->getVar('location'),
      'job_content'   => $this->request->getVar('content'),
      'publish'       => 1,
      'active'        => 1,
      'opening_at'    => $formatted_opening,
      'closed_at'     => $formatted_closed,
      'created_at'    => date('Y-m-d H:i:s'),
      'created_by'    => session()->get('user_data')['username'],
      'updated_at'    => date('Y-m-d H:i:s'),
      'updated_by'     => session()->get('user_data')['username'],
    ];

    $save = $this->jobs->save($input);
    if($save)
    {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('message', 'Success Add New Jobs!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Add Jobs. Try Again!');
    }
  }

  public function datatables_jobs_dashboard()
  {
    $requestData = $this->request->getPost();

    $data = [];
    $data['draw'] = $requestData['draw'];
    $data['recordsTotal'] = $this->jobs->countAllTotalJobActive();
    $data['recordsFiltered'] = $data['recordsTotal'];
    $data['data'] = $this->jobs->getAllJobs($requestData);

    return $this->response->setJSON($data);
  }

  public function update_jobs($uid)
  {
    $opening_at = $this->request->getVar('opening');
    $formatted_opening = date('Y-m-d', strtotime($opening_at));

    $closed_at = $this->request->getVar('closed');
    $formatted_closed = date('Y-m-d', strtotime($closed_at));

    $input = [
      'uid_hash'      => $this->request->getVar('uid'),
      'id_company'    => $this->request->getVar('company'),
      'id_department' => $this->request->getVar('department'),
      'id_level'      => $this->request->getVar('level'),
      'id_position'   => $this->request->getVar('position'),
      'id_contracts'   => $this->request->getVar('contract'),
      'id_location'   => $this->request->getVar('location'),
      'job_content'   => $this->request->getVar('content'),
      'publish'       => 1,
      'active'        => 1,
      'opening_at'    => $formatted_opening,
      'closed_at'     => $formatted_closed,
      'created_at'    => date('Y-m-d H:i:s'),
      'created_by'    => session()->get('user_data')['username'],
      'updated_at'    => date('Y-m-d H:i:s'),
      'updated_by'     => session()->get('user_data')['username'],
    ];

    $update = $this->jobs->update_job($uid, $input);
    if($update == 1)
    {
      return redirect()->to('view-job')->with('message', 'Success Update Jobs!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Update Jobs. Try Again!');
    }
  }

  public function datatables_role()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'role_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_role';
    $data = $this->role->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->role->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_level()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'level_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_level';
    $data = $this->level->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->level->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_position()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'level_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_level';
    $data = $this->position->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->position->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_location()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'level_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_level';
    $data = $this->location->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->location->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_department()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'level_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_level';
    $data = $this->department->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->department->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_company()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_role',
      2 => 'level_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_level';
    $data = $this->company->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->company->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_contract()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_contract',
      2 => 'contract_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_contract';
    $data = $this->contract->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->contract->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_items()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_items',
      2 => 'nama_barang'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_items';
    $data = $this->items_data->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->items_data->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function datatables_items_type()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_items_type',
      2 => 'item_type_name'
    ];

    $order_by = $column_mapping[$order_column] ?? 'id_items_type';
    $data = $this->items_type->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->items_type->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );

    return json_encode($json_data);
  }

  public function add_item_stock()
  {
    $request = $this->request->getPost();
    $input = [
      'nama_barang'     => $request['nama_barang'],
      'is_deleted'      => 0,
      'created_at'      => date('Y-m-d H:i:s'),
      'created_by'      => session()->get('user_data')['username']
    ];
    $saves = $this->items_data->save($input);
    if($saves) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function update_items($id_items)
  {
    $id_items = $this->request->getVar('id_items');
    $input = [
      'nama_barang'   => $this->request->getVar('nama_barang'),
      'stock_quantity'  => $this->request->getVar('stock_quantity'),

      'updated_at'  => date('Y-m-d H:i:s'),
      'updated_by'  => $this->session->get('user_data')['username']
    ];

    $updates = $this->items_data->update($id_items, $input);
    if($updates)
    {
      return redirect()->route('add-item')->with('message', 'Success Edit Items - '.$input['nama_barang'].'!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Edit Items. Try Again!');
    }
  }

  public function delete_items($id_items)
  {
    $input = [
      'is_deleted' => 1,
      'updated_at'  => date('Y-m-d H:i:s'),
      'updated_by'  => $this->session->get('user_data')['username']
    ];
    $updates = $this->items_data->update($id_items, $input);
    if($updates)
    {
      return redirect()->route('add-item')->with('message', 'Success Deleted Items!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Deleted Items. Try Again!');
    }
  }

  public function add_item_type()
  {
    $request = $this->request->getPost();
    $input = [
      'item_type_name'     => $request['item_type_name'],
      'is_deleted'         => 0,
    ];
    $saves = $this->items_type->save($input);
    if($saves) {
      $response = "<i class='bi bi-check2-circle'></i>&nbsp; Save success!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
    else{
      $response = "<i class='bi bi-x'></i>&nbsp; Save failed!";
      $data = ['status' => $response];
      return $this->response->setJSON($data);
    }
  }

  public function update_items_type($id_items_type)
  {
    $id_items_type = $this->request->getVar('id_items_type');
    $input = [
      'item_type_name'   => $this->request->getVar('item_type_name'),
    ];

    $updates = $this->items_type->update($id_items_type, $input);
    if($updates)
    {
      return redirect()->route('add-item-type')->with('message', 'Success Edit Items Type - '.$input['item_type_name'].'!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Edit Items. Try Again!');
    }
  }

  public function delete_items_type($id_items_type)
  {
    $input = [
      'is_deleted' => 1,
    ];
    $updates = $this->items_type->update($id_items_type, $input);
    if($updates)
    {
      return redirect()->route('add-item-type')->with('message', 'Success Deleted Items!');
    } else {
      return redirect()->to($_SERVER['HTTP_REFERER'])->with('error', 'Failed Deleted Items. Try Again!');
    }
  }

  public function datatables_items_transaction()
  {
    $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
    $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;
    $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $order_column = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $order_dir = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'asc';
      
    $column_mapping = [
      1 => 'id_transaction',
      2 => 'items_name',
    ];

    $order_by = $column_mapping[$order_column] ?? '';
    $data = $this->items_transaction->getAll($search_value, $start, $length, $order_by, $order_dir);  
    $total_count = $this->items_transaction->getAll($search_value);
    $json_data = array(
      'draw' => intval($param['draw']),
      'recordsTotal' => count($total_count),
      'recordsFiltered' => count($total_count),
      'data' => $data
    );
    return json_encode($json_data);
  }

  public function takeItem()
  {
    $id_items = $this->request->getPost('id_items');
    $jumlah = $this->request->getPost('jumlah');

    // Cek apakah item ada di database
    $item = $this->items_data->find($id_items);
    if (!$item) {
      return redirect()->back()->with('message', 'Item not found');
    }

        // Dapatkan stok yang ada
    $transaction = $this->items_transaction->where('id_items', $id_items)->orderBy('tanggal_transaction', 'DESC')->first();
    if ($transaction) {
      $new_stock = $transaction['stock'] - $jumlah;
      if ($new_stock < 0) {
        return redirect()->back()->with('message', 'Insufficient stock');
      }
    } else {
      return redirect()->back()->with('message', 'Transaction not found');
    }

        // Buat row baru di items_transaction
    $transactionData = [
        'id_items' => $id_items,
        'id_items_type' => $transaction['id_items_type'],
        'stock' => $new_stock,
        'banyaknya_jual' => $jumlah,
        'tanggal_transaction' => date('Y-m-d')
    ];
    $this->items_transaction->insert($transactionData);

    return redirect()->back()->with('message', 'Stock updated successfully');
  }
}
