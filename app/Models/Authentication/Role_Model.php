<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table            = 'user_role';
    protected $primaryKey       = 'id_role';
    protected $allowedFields    = [];

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

  public function getAll($like = null, $start = 0, $length = 0, $order_by = null, $order_dir = 'asc')
  {
    $builder = $this->table($this->table);

    if ($like) 
    {
      $arr_like = explode(" ", $like);
      for ($x = 0; $x < count($arr_like); $x++) {
        $builder = $builder->like('role_name', $arr_like[$x]);
      }
    }
  
    // Order by condition
    if ($order_by) {
      $builder = $builder->orderBy('role_name', $order_dir);
    }
  
    // Limit condition
    if ($start != 0 or $length != 0) {
      $builder = $builder->limit($length, $start);
    }
  
    return $builder->get()->getResultArray();
  }
}
