<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    unauth_redirect(base_url(''));
  }

  public function index()
  {
    show_page('dashboard/index', [
      'title' => 'Dashboard'
    ]);
  }
}