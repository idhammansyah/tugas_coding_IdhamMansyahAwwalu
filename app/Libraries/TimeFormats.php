<?php 

namespace App\Libraries;

use CodeIgniter\I18n\Time;
use Config\App;

class TimeFormats {
  
  public function human($date_time, $timezone) {
    return Time::parse($date_time, $timezone)->humanize();
  }
  
  // how to run in view
  //<?= view_cell
  //            Library                         from database              select timezone
  // ('App\Libraries\TimeFormats::human', ['date_time' => $b->updated_at, 'timezone' => 'Asia/Jakarta'] ); ? >
  
}