<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'models/Base_model.php');

class Meeting_model extends Base_model
{
  public $table = 'meeting';

  public function getAll($accepted = true)
  {
    $data = $this->db
      ->select("$this->table.*")
      ->select('user.fullname AS user_fullname')
      ->select('guest.fullname AS guest_fullname')
      ->select('guest.email AS guest_email')
      ->select('opd.name AS opd_name')
      ->select('room.name AS room_name')
      ->select('admin.fullname AS accepted_by_name')
      ->join('user', "user.id = $this->table.booked_by_user", 'LEFT')
      ->join('guest', "guest.id = $this->table.booked_by_guest", 'LEFT')
      ->join('user AS admin', "admin.id = $this->table.accepted_by", 'LEFT')
      ->join('room', "room.id = $this->table.room", 'LEFT')
      ->join('opd', "opd.id = user.opd", 'LEFT');

    if ($accepted != null) {
      $data->where('accepted', $accepted);
    }
    
    return $data->get($this->table)->result();
  }

  public function getFilteredList($limit, $start, $filter, $search, $user_id = null)
  {
    $result = $this->db
      ->select("$this->table.*")
      ->select('user.fullname AS user_fullname')
      ->select('guest.fullname AS guest_fullname')
      ->select('guest.email AS guest_email')
      ->select('opd.name AS opd_name')
      ->select('room.name AS room_name')
      ->select('admin.fullname AS accepted_by_name')
      ->join('user', "user.id = $this->table.booked_by_user", 'LEFT')
      ->join('guest', "guest.id = $this->table.booked_by_guest", 'LEFT')
      ->join('user AS admin', "admin.id = $this->table.accepted_by", 'LEFT')
      ->join('room', "room.id = $this->table.room", 'LEFT')
      ->join('opd', "opd.id = user.opd", 'LEFT');

    if ($user_id != null) {
      $result->where('booked_by_user', $user_id);
    }
    
    switch ($filter) {
      case 'accepted':
        $result->where('accepted', true);
        break;
        
      case 'declined':
        $result->where('accepted', false);
        break;
      
      case 'pending':
        $result->where('accepted', null);
        break;
    }

    if (isset($search) && !empty($search)) {
      $result->group_start();
      $result->like('meeting_title', $search);
      $result->or_like('description', $search);
      $result->group_end();
    }
      
    return $result->get($this->table, $limit, $start)->result();
  }

  public function getGuestFilteredList($limit, $start)
  {
    $result = $this->db
      ->select('meeting.meeting_title')
      ->select('meeting.meeting_leader')
      ->select('meeting.meeting_participant')
      ->select('meeting.opd')
      ->select('user.fullname AS user_fullname')
      ->select('guest.fullname AS guest_fullname')
      ->select('guest.email AS guest_email')
      ->select('opd.name AS opd_name')
      ->select('room.name AS room_name')
      ->select('admin.fullname AS accepted_by_name')
      ->select('CASE WHEN start_time <= NOW() AND finish_time >= NOW() THEN \'ongoing\' WHEN start_time > NOW() AND finish_time > NOW() THEN \'willbeheld\' WHEN start_time < NOW() AND finish_time < NOW() THEN \'alreadyunderway\' END AS status')
      ->select('CASE WHEN "meeting".start_time < TO_CHAR(NOW( ), \'YYYY-mm-DD 07:00:00\') :: timestamp THEN \'07:00:00\' :: time ELSE "meeting".start_time :: time END AS start_time')
      ->select('CASE WHEN "meeting".finish_time >  TO_CHAR(NOW( ), \'YYYY-mm-DD 23:59:59\') :: timestamp THEN \'23:59:59\' :: time ELSE "meeting".finish_time  :: time END AS finish_time')
      ->join('user', "user.id = $this->table.booked_by_user", 'LEFT')
      ->join('guest', "guest.id = $this->table.booked_by_guest", 'LEFT')
      ->join('user AS admin', "admin.id = $this->table.accepted_by", 'LEFT')
      ->join('room', "room.id = $this->table.room", 'LEFT')
			->join('opd', "opd.id = user.opd", 'LEFT')
      ->where('accepted', true)
      ->where('(start_time) :: date <= TO_CHAR( NOW( ), \'YYYY mm DD\' ) :: date')
      ->where('(finish_time) :: date >= TO_CHAR( NOW( ), \'YYYY mm DD\' ) :: date');
      
    return $result->get($this->table, $limit, $start)->result();
  }

  public function getGuestRowCount() {
    return $this->db
      ->from($this->table)
      ->where('accepted', true)
      ->where('(start_time) :: date <= TO_CHAR( NOW( ), \'YYYY mm DD\' ) :: date')
      ->where('(finish_time) :: date >= TO_CHAR( NOW( ), \'YYYY mm DD\' ) :: date')
      ->count_all_results();
  }

  public function getRowCount($filter, $search, $user_id = null)
  {
    $result = $this->db->from($this->table);
      
    if ($user_id != null) {
        $result->where('booked_by_user', $user_id);
    }

    switch ($filter) {
      case 'accepted':
        $result->where('accepted', true);
        break;
        
      case 'declined':
        $result->where('accepted', false);
        break;
      
      case 'pending':
        $result->where('accepted', null);
        break;
    }

    if (isset($search) && !empty($search)) {
      $result->group_start();
      $result->like('meeting_title', $search);
      $result->group_end();
    }
      
    return $result->count_all_results();
  }

  public function getById($id)
  {
    return $this->db
      ->select("$this->table.*")
      ->select('user.fullname as user_fullname')
      ->select('guest.fullname as guest_fullname')
      ->select('guest.email as guest_email')
      ->select('user.email as user_email')
      ->select('room.name as room_name')
      ->select('opd.name AS opd_name')
      ->select('admin.fullname AS accepted_by_name')
      ->join('user', "user.id = $this->table.booked_by_user", 'LEFT')
      ->join('guest', "guest.id = $this->table.booked_by_guest", 'LEFT')
      ->join('user AS admin', "admin.id = $this->table.accepted_by", 'LEFT')
      ->join('room', "room.id = $this->table.room", 'LEFT')
      ->join('opd', "opd.id = user.opd", 'LEFT')
      ->get_where($this->table, ["$this->table.id" => $id])
      ->row();
  }

  public function isNotValidRange($start_time, $finish_time, $room)
  {
    $room_id = array();

    $children = $this->db
      ->where('id', $room)
      ->or_where('parent_id', $room)
      ->get('room')
      ->result();

    foreach ($children as &$child)
      array_push($room_id, $child->id);

    foreach ($children as &$child) {
      if ($child->parent_id != NULL) {
        array_push($room_id, $child->parent_id);
        break;
      }
    }

    $conflict = $this->db
      ->where_in('room', $room_id)
      ->group_start()
        ->group_start()
          ->where('start_time >=', $start_time)
          ->where('start_time <=', $finish_time)
        ->group_end()
        ->or_group_start()
          ->where('finish_time >=', $start_time)
          ->where('finish_time <=', $finish_time)
        ->group_end()
      ->group_end()
      ->where('accepted', true)
      ->from('meeting')
      ->count_all_results();
    
    return $conflict > 0;
  }
}
