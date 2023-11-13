<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'models/Base_model.php');

class Guest_model extends Base_model {
  public $table = 'guest';

  function storeOrUpdate($data) {
    $guest = $this->db
        ->from($this->table)
        ->where('email', $data['email'])
        ->limit(1)
        ->get()
        ->row();

    if ($guest == null) {
        $this->db->insert($this->table, $data);
        $guest = $this->db->insert_id();
    } else {
        $this->db->update($this->table, $data, ['id' => $guest->id]);
        $guest = $guest->id;
    }

    return $guest;
  }
}
