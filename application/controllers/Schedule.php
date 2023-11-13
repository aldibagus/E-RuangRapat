<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    unauth_redirect(base_url(''));
    $this->load->model('Meeting_model');
  }

  public function index()
  {
    show_page('schedule/index', [
      'title' => 'Jadwal',
      'meetings' => $this->Meeting_model->getAll(null)
    ]);
  }
}