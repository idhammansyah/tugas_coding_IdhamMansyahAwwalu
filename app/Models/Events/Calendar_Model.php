<?php

namespace App\Models\Events;

use CodeIgniter\Model;

class Calendar_Model extends Model
{
  protected $table              = 'calendar_events';
  protected $role_table         = 'user_role';
  
  protected $primaryKey         = 'id_events';
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

  public function getDate()
	{
		$sql = 'SELECT * FROM '.$this->table.' WHERE status_event = 1 ORDER BY created_at DESC';
		
		return $this->db->query($sql)->getResultArray();
	}

  public function deleteData($id) 
  {
		$query = $this->db->query('UPDATE '.$this->table.' SET status_event = 0, updated_at = "'.date('Y-m-d H:i:s').'", updated_by = "'.session()->get('user_data')['username'].'" WHERE id_events = '.$id.'');

    return 1;
	}
}