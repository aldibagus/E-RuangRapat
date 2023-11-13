<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {
  public function count()
  {
    return $this->db->count_all($this->table);
  }

  public function getAll()
  {
    return $this->db->get($this->table)->result();
  }

  public function getList($limit, $start)
  {
    return $this->db->get($this->table, $limit, $start)->result();
  }

  public function getById($id)
  {
    return $this->db->get_where($this->table, compact('id'))->row();
  }

  public function store($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function updateById($id, $data)
  {
    return $this->db->update($this->table, $data, compact('id'));
  }

  public function deleteById($id)
  {
    return $this->db->delete($this->table, compact('id'));
  }
}