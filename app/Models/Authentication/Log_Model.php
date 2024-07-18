<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class Log_Model extends Model
{
  protected $table      = 'user_log_activity';
  protected $company    = 'm_company';
  protected $department = 'm_department';
  protected $users = 'users';
  protected $primaryKey = 'id_log';
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

  public function view_all()
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." a JOIN ".$this->users." b ON a.id_user = b.id_user ORDER BY a.created DESC LIMIT 5");

    return $query->getResultArray();
  }

  public function getCompany()
  {
    $query = $this->db->query("
      SELECT * FROM ".$this->company." ORDER BY company_name ASC
    ");

    return $query->getResultArray();
  }

  public function getDepartment()
  {
    $query = $this->db->query("
      SELECT * FROM ".$this->department." ORDER BY department_name ASC
    ");

    return $query->getResultArray();
  }
}