<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/Base_model.php');

class User_model extends Base_model {
  public $table = 'user';

  public function getList($limit, $start)
  {
    return $this->db
      ->select("$this->table.*")
      ->select('opd.name AS opd_name')
      ->join('opd', 'opd.id = user.opd', 'LEFT')
      ->get($this->table, $limit, $start)
      ->result();
  }
}