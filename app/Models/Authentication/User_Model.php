<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class User_Model extends Model
{
  protected $table            = 'users';
  protected $company          = 'm_company';
  protected $department       = 'm_department';
  protected $role_table       = 'user_role';
  protected $primaryKey       = 'id_user';
  protected $allowedFields      = [];

  public function __construct()
  {
    parent::__construct();
    $this->allowedFields = $this->getAllowedFields();
  }

  function getAllowedFields()
  {
    $fields = $this->db->getFieldNames($this->table);
    return $fields;
  }

  public function getProfile()
  {
    $query = $this->db->query('SELECT * FROM '.$this->table.' a
    JOIN '.$this->role_table.' b ON a.role_id = b.id_role
    JOIN '.$this->company.' c ON a.company_id = c.id_company
    JOIN '.$this->department.' d ON a.department_id = d.id_dept WHERE a.id_user = '.session()->get('user_data')['id_user'].'');

    return $query->getRowArray();
  }

  public function isEmailRegistered($email)
  {
    $user = $this->where('email', $email)->first();
    return ($user) ? true : false;
  }

  public function isusernameRegistered($username)
  {
    $user = $this->where('username', $username)->first();
    return ($user) ? true : false;
  }

  public function checking_token($token)
  {
    $query = $this->db->query("
      SELECT * FROM ".$this->table." WHERE reset_hash  = '".$token."'
    ");

    return $query->getRowArray();
  }

  // set session below
  public function check_account($username, $email)
  {
    $query = $this->db->query("
      SELECT * FROM ".$this->table." a
      JOIN ".$this->company." b ON b.id_company = a.company_id
      JOIN ".$this->department." c ON c.id_dept = a.department_id
      WHERE a.username='".$username."' OR a.email = '".$email."'
    ");

    $userData = $query->getRowArray();

    if ($userData) {
      // Menyimpan data ke dalam session
      
      session()->set('user_data', $userData);
    }

    return $userData;
  }

  public function view_all_user()
  {
    $query = $this->db->query('SELECT * FROM '.$this->table.' a
    JOIN '.$this->role_table.' b ON a.role_id = b.id_role
    JOIN '.$this->company.' c ON a.company_id = c.id_company
    JOIN '.$this->department.' d ON a.department_id = d.id_dept');

    return $query->getResultArray();
  }

  public function getAllUsers($requestData)
  {
    $builder = $this->db->table($this->table . ' a');
      $builder->select('a.*, b.*, c.*, d.*');
      $builder->join($this->role_table . ' b', 'a.role_id = b.id_role');
      $builder->join($this->company . ' c', 'a.company_id = c.id_company');
      $builder->join($this->department . ' d', 'a.department_id = d.id_dept');
      $builder->where('c.company_name IS NOT NULL');
      $builder->where('d.department_name IS NOT NULL');

    // Set order
    if (!empty($requestData['order'])) 
    {
      $builder->orderBy($requestData['columns'][$requestData['order'][0]['column']]['data'], $requestData['order'][0]['dir']);
    }

    // Set limit and offset
    if (!empty($requestData['length']) && $requestData['length'] != -1) 
    {
      $builder->limit($requestData['length'], $requestData['start']);
    }

    return $builder->get()->getResultArray();
  }

  public function countAllTotalUser()
  {
    $builder = $this->db->table($this->table);
    $where = 'company_id IS NOT NULL AND department_id IS NOT NULL';
    $count = $builder->where($where)->countAllResults();
    return $count;
  }
}
