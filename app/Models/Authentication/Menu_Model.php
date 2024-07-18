<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class Menu_Model extends Model
{
  protected $table              = 'user_menu';
  protected $role_table         = 'user_role';
  
  protected $primaryKey         = 'menu_id';
  protected $primaryKey_submenu = 'id_sub_menu';
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

  function menu_check()
  {
    $query = $this->db->query("
      SELECT * FROM ".$this->table." a
      JOIN ".$this->role_table." b ON a.id_role = b.id_role
      ORDER BY urutan
    ");

    return $query->getResultArray();
  }

  public function getMenu($category_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." WHERE id_menu_category = ".$category_id." ORDER BY urutan, menu_name ASC");
    
    return $query->getResultArray();
  }

  public function getSubmenu($menuId)
  {
    $query = $this->db->query("SELECT * FROM ".$this->sub_menu." WHERE menu_id = ".$menuId." ORDER BY urutan ASC");
    
    return $query->getResultArray();
  }

  public function updateMenuOrder($menu_order)
  {
    foreach ($menu_order as $key => $id) {
      $this->set('urutan', $key)->where('menu_id', $id)->update();
    }
    // return 1;
  }
}
