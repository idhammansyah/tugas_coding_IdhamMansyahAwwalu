<?php

namespace App\Models\Authentication;

use CodeIgniter\Model;

class Tokenize_Model extends Model
{
    protected $table      = 'tokenize';
    protected $user = 'users';
    protected $primaryKey = 'id_tokenize';
    protected $allowedFields = [
      'email', 'token', 'status', 'informasi', 'created_at', 'expired_at',
    ];

    public function checkToken($token, $email)
    {
      $query = $this->db->query("
        SELECT * FROM ".$this->table." WHERE token = '".$token."' AND email = '".$email."' AND status = 0
      ");

      return $query->getNumRows();
    }
    
    public function checkTokenReactivate($token, $email)
    {
      $query = $this->db->query("
        SELECT * FROM ".$this->table." WHERE token = '".$token."' AND email = '".$email."'
        AND status = 0
      ");

      return $query->getNumRows();
    }
    
    public function activateToken($token, $email)
    {
      $query = $this->db->query("
        UPDATE ".$this->table." 
        SET 
          status = 1,
          informasi = 'Aktivasi berhasil'
        WHERE token = '".$token."' AND email = '".$email."'
      ");

      return $query;
    }
    
    public function activateTokenReactivate($token, $email)
    {
      $query = $this->db->query("
        UPDATE ".$this->table." SET 
          status = 1,
          informasi = 'Re-Aktivasi berhasil'
        WHERE token = '".$token."' AND email = '".$email."'
      ");
      return $query;
    }
    
    public function activateUser($email)
    {
      $query = $this->db->query("
        UPDATE ".$this->user." SET 
          status_akun = 1,
          status = 'verified' 
        WHERE email = '".$email."'
      ");
      return $query;
    }

}