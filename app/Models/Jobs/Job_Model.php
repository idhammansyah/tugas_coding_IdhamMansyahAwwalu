<?php

namespace App\Models\Jobs;

use CodeIgniter\Model;

class Job_Model extends Model
{
  protected $table            = 'jobs';
  protected $company          = 'm_company';
  protected $contract         = 'm_contract';
  protected $department       = 'm_department';
  protected $level            = 'm_level';
  protected $location         = 'm_location';
  protected $position         = 'm_position';

  protected $primaryKey       = 'id_jobs';
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

  public function countAllTotalJobActive()
  {
    $builder = $this->db->table($this->table);
    $where = 'publish = 1 AND active = 1';
    $count = $builder->where($where)->countAllResults();
    return $count;
  }

  public function getAllJobs($requestData)
  {
    $builder = $this->db->table($this->table . ' a');
      $builder->select('a.*, b.*, c.*, d.*, e.*, f.*');
      $builder->join($this->company . ' b', 'a.id_company = b.id_company');
      $builder->join($this->contract . ' c', 'a.id_contracts = c.id_contract');
      $builder->join($this->department . ' d', 'a.id_department = d.id_dept');
      $builder->join($this->level . ' e', 'a.id_level = e.id_level');
      $builder->join($this->position . ' f', 'a.id_position = f.id_position');
      $builder->where('a.publish = 1');
      $builder->where('a.active = 1');

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
  
  public function finds_job($id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." WHERE uid_hash = '$id'");
    return $query->getRowArray();
  }

  public function update_job($uid, $array)
  {
    // $db = \Config\Database::connect();
    // $builder = $db->table($this->table);
    // $builder->set($array);
    // $builder->where('uid_hash', $uid); 

    // $builder->update($this->table);
    // return 1;
    $query = $this->db->query("UPDATE ".$this->table." SET
      id_company = ".$array['id_company'].",
      id_department = ".$array['id_department'].",
      id_level = ".$array['id_level'].",
      id_position = ".$array['id_position'].",
      id_contracts = ".$array['id_contracts'].",
      id_location = ".$array['id_location'].",
      job_content = '".$array['job_content']."',
      publish = '".$array['publish']."',
      active = '".$array['active']."',
      opening_at = '".$array['opening_at']."',
      closed_at = '".$array['closed_at']."',
      created_at = '".$array['created_at']."',
      created_by = '".$array['created_by']."',
      updated_at = '".$array['updated_at']."',
      updated_by = '".$array['updated_by']."'
    WHERE
      uid_hash = '".$array['uid_hash']."'
    ");

    return 1;
  }
}