<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class SubMenu_Model extends Model
{
  protected $table              = 'user_sub_menu';
  protected $role_table         = 'user_role';
  
  protected $primaryKey         = 'id_sub_menu';
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

  public function getSubmenu($menuId)
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." WHERE menu_id = ".$menuId." ORDER BY urutan, sub_menu_name ASC");
    
    return $query->getResultArray();
  }

  public function updateMenuOrder($submenu_order)
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." WHERE id_sub_menu = ".$submenu_order." ORDER BY urutan, sub_menu_name ASC");

    return $query->getResultArray();
  }
}
