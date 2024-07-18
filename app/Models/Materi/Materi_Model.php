<?php

namespace App\Models\Materi;

use CodeIgniter\Model;

class Materi_Model extends Model
{
  protected $table          = 'materi';
  protected $user           = 'users';
  
  protected $primaryKey     = 'id_materi';
  protected $allowedFields  = [];

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
  
  function getMateri()
  {
    $query = $this->db->query("SELECT * FROM ".$this->table." a JOIN ".$this->user." b ON a.id_pengisi_materi = b.id_user WHERE a.delete = 0 ORDER BY tgl_posting, publish = 1 DESC");
    
    return $query->getResultArray();
  }

}