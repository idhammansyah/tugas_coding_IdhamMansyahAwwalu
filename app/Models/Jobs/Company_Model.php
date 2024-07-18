<?php

namespace App\Models\Jobs;

use CodeIgniter\Model;

class Company_Model extends Model
{
  protected $table            = 'm_company';
  protected $jobs             = 'jobs';
  protected $contract         = 'm_contract';
  protected $department       = 'm_department';
  protected $level            = 'm_level';
  protected $location         = 'm_location';
  protected $position         = 'm_position';

  protected $primaryKey       = 'id_company';
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

  public function getAll($like = null, $start = 0, $length = 0, $order_by = null, $order_dir = 'asc')
  {
    $builder = $this->table($this->table);

    if ($like) 
    {
      $arr_like = explode(" ", $like);
      for ($x = 0; $x < count($arr_like); $x++) {
        $builder = $builder->like('company_name', $arr_like[$x]);
      }
    }
  
    // Order by condition
    if ($order_by) {
      $builder = $builder->orderBy('company_name', $order_dir);
    }
  
    // Limit condition
    if ($start != 0 or $length != 0) {
      $builder = $builder->limit($length, $start);
    }
  
    return $builder->get()->getResultArray();
  }
}