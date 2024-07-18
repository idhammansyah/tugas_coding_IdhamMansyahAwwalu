<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class Menu_Category_Model extends Model
{
  protected $table              = 'user_menu_category';
  
  protected $user_menu          = 'user_menu';
  protected $role_table         = 'user_role';

  protected $primaryKey         = 'id_menu_category';
  protected $primaryKeyMenu     = 'menu_id';
  protected $secondaryKeyMenu   = 'id_menu_category';
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

  public function getMenuCategory()
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." a JOIN ".$this->user_menu." b ON b.".$this->primaryKeyMenu." = b.".$this->primaryKey." WHERE a.is_active = 1 ORDER BY a.urutan");

    return $query->getResultArray();
  }
}
