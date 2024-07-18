<?php

namespace App\Models\Datastock;

use CodeIgniter\Model;

class ItemTransactionModel extends Model
{
  protected $table            = 'items_transaction';
  protected $primaryKey       = 'id_transaction';
  
  protected $table_type       = "data_items_type";
  protected $primaryKeyType   = "id_items_type";
  
  protected $table_items      = "data_items";
  protected $primaryKeyItems  = "id_items";
  
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
    $builder = $this->db->table($this->table . ' a');
    $builder->join('data_items b', 'b.id_items = a.id_items');
    $builder->join('data_items_type c', 'c.id_items_type = a.id_items_type');

    if ($like) 
    {
      $arr_like = explode(" ", $like);
      for ($x = 0; $x < count($arr_like); $x++) {
        $builder->like('b.nama_barang', $arr_like[$x]);
        $builder->orLike('a.tanggal_transaction', $arr_like[$x]);
      }
    }
  
    // Order by condition
    if ($order_by) {
      $builder->orderBy($order_by, $order_dir);
    } else {
      // Default ordering
      $builder->orderBy('a.tanggal_transaction', $order_dir);
      $builder->orderBy('b.nama_barang', $order_dir);
    }
  
    // Limit condition
    if ($start != 0 or $length != 0) {
      $builder = $builder->limit($length, $start);
    }
  
    return $builder->get()->getResultArray();
  }

  
}