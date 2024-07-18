<?php

namespace App\Models\Datastock;

use CodeIgniter\Model;

class ItemsModel extends Model
{
  protected $table            = 'data_items';
  protected $primaryKey       = 'id_items';
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
    $builder->where('is_deleted', 0);

    if ($like) 
    {
      $arr_like = explode(" ", $like);
      for ($x = 0; $x < count($arr_like); $x++) {
        $builder = $builder->like('nama_barang', $arr_like[$x]);
      }
    }
  
    // Order by condition
    if ($order_by) {
      $builder = $builder->orderBy('nama_barang', $order_dir);
    }
  
    // Limit condition
    if ($start != 0 or $length != 0) {
      $builder = $builder->limit($length, $start);
    }
  
    return $builder->get()->getResultArray();
  }

  
}