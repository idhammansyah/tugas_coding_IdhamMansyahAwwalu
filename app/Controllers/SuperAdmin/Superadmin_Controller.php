<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use CodeIgniter\Controller;

class Superadmin_Controller extends BaseController
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

    $this->items_data = model('App\Models\Datastock\ItemsModel');
    $this->items_type = model('App\Models\Datastock\ItemsTypeModel');
    $this->items_transaction = model('App\Models\Datastock\ItemTransactionModel');

    $this->session = \Config\Services::session();
    $this->validation = \Config\Services::validation();
    
    $this->views = 'v_admin';
  }

  public function index()
  {
    $data = [
      'title'           => "Dashboard",
      'breadcrumb'      => $this->breadcrumb,
      'activities_log'  => $this->log_activity->view_all()
    ];

    return view($this->views.'/v_dashboard', $data);
  }

  public function add_account()
  {
    $data = [
      'title' => 'Add Account'
    ];

    return view($this->views. '/add_account', $data);
  }

  public function view_users()
  {
    $data = [
      'title'       => 'View All Users',
      'company'     => $this->log_activity->getCompany(),
      'dept'        => $this->log_activity->getDepartment(),
      'role'        => $this->role->findAll(),
      ''
    ];

    return view($this->views.'/v_users', $data);
  }

  public function v_menu_management()
  {
    $data = [
      'title' => 'Super Admin - Menu Management',
      'menu_category' => $this->menu_category->orderBy('nama_menu_category', 'ASC')->findAll(),
      'breadcrumb'  => $this->breadcrumb,
      'menu'  => $this->menu->menu_check(),
      'role'  => $this->role->orderBy('role_name', 'ASC')->findAll()
    ];
    
    return view($this->views.'/v_menu_manage', $data);
  }

  public function v_calendar()
  {
    $data = [
      'title'   => 'View Calendar'
    ];
    
    return view($this->views.'/v_calendar', $data);
  }

  public function update_view_calendar($id)
  {
    $data = [
      'title'     => 'Edit Events - ' . $id,
      'events'    => $this->calendar_events->find($id)
    ];

    return view($this->views.'/v_update_calendar', $data);
  }

  public function v_material()
  {
    $data = [
      'title'     => 'Learning Materials',
      'pemateri'  => $this->users->where('role_id', '2')->findAll(),
      'materi'    => $this->materials->getMateri()
    ];

    return view($this->views.'/v_materials', $data);
  }

  public function v_myprofile()
  {
    $data = [
      'title'     => 'My Profile',
      'profile'   => $this->users->getProfile(),
      'company'   => $this->log_activity->getCompany(),
      'department'=> $this->log_activity->getDepartment(),
    ];

    return view($this->views.'/v_myprofile', $data);
  }

  public function v_jobs() 
  {
    $data = [
      'title'       => 'View Jobs',
      'company'     => $this->company->findAll(),
      'dept'        => $this->department->findAll(),
      'level'       => $this->level->findAll(),
      'position'    => $this->position->findAll(),
      'location'    => $this->location->findAll(),
      'contract'    => $this->contract->findAll()
    ];

    return view($this->views.'/v_jobs', $data);
  }

  public function edit_job($id)
  {
    $data = [
      'title'       => 'Edit Job - ' . $id,
      'jobs'        => $this->jobs->finds_job($id),
      'company'     => $this->company->findAll(),
      'dept'        => $this->department->findAll(),
      'level'       => $this->level->findAll(),
      'position'    => $this->position->findAll(),
      'location'    => $this->location->findAll(),
      'contract'    => $this->contract->findAll()
    ];

    return view($this->views.'/v_edit_job', $data);
  }
  
  public function v_who_applied($id)
  {
    $data = [
      'title'     => 'View Applied - ' . $id,
    ];

    return view($this->views.'/v_applied', $data);
  }

  public function v_role() 
  {
    $data = [
      'title'     => 'View All Role',
    ];

    return view($this->views.'/v_role', $data);
  }

  public function v_level() 
  {
    $data = [
      'title'     => 'View All Job Level',
    ];

    return view($this->views.'/v_level', $data);
  }

  public function v_position() 
  {
    $data = [
      'title'     => 'View All Job Level',
    ];

    return view($this->views.'/v_position', $data);
  }

  public function v_location()
  {
    $data = [
      'title'     => 'View All Location',
    ];

    return view($this->views.'/v_location', $data);
  }

  public function v_department()
  {
    $data = [
      'title'     => 'View All Department',
    ];

    return view($this->views.'/v_department', $data);
  }

  public function v_company()
  {
    $data = [
      'title'     => 'View All Company',
    ];

    return view($this->views.'/v_company', $data);
  }

  public function v_contract()
  {
    $data = [
      'title'     => 'View All Contract',
    ];

    return view($this->views.'/v_contract', $data);
  }

  public function v_adding_items()
  {
    $data = [
      'title'     =>  "Super Admin - Adding Items",
      'items'     => $this->items_data->findAll()
    ];

    return view($this->views.'/v_add_items', $data);
  }

  public function v_adding_type()
  {
    $data = [
      'title'     =>  "Super Admin - Adding Type",
      'items'     => $this->items_type->findAll()
    ];

    return view($this->views.'/v_add_type', $data);
  }

  public function v_edit_barang($id_barang)
  {
    $data = [
      'title'     =>  "Super Admin - Edit Items",
      'items'     => $this->items_data->find($id_barang)
    ];

    return view($this->views.'/v_edit_barang', $data);
  }

  public function v_edit_type($id_type)
  {
    $data = [
      'title'     =>  "Super Admin - Edit Items",
      'items'     => $this->items_type->find($id_type)
    ];
    
    return view($this->views.'/v_edit_barang_type', $data);
  }

  public function v_item_transaction()
  {
    $data = [
      'title'     =>  "Super Admin - Item Transaction",
      'items_transaction'     => $this->items_transaction->findAll(),
      'items'     => $this->items_data->findAll()
    ];

    return view($this->views.'/v_item_transaction', $data);
  }
}