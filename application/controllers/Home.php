<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Meeting_model');
	}

	public function index()
	{
		$this->load->view(
			'pages/visitor/index',
			array('meetings' => $this->Meeting_model->getAll())
		);
	}
}
