<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		user_redirect(base_url('dashboard'));
		$this->load->model('User_model');
		$this->load->model('OPD_model', 'opd_model');
	}

	public function index()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url('user');
		$config['per_page'] = 10;
		$config['total_rows'] = $this->User_model->count();

		$this->pagination->initialize($config);

		$page = $this->input->get('page') ? $this->input->get('page') : 0;

		show_page('user/index', [
			'title' => 'User',
			'create_url' => base_url('user/create'),
			'users' => $this->User_model->getList($config["per_page"], $page),
			'pagination' => $this->pagination->create_links()
		]);
	}

	public function create()
	{
		show_page('user/create', [
			'title' => 'Buat User',
			'opds' => $this->opd_model->getAll()
		]);
	}

	public function store()
	{
		if ($this->form_validation->run('store_user') == FALSE) {
			return $this->create();
		}

		$data = [
			'id' => $this->input->post('nip'),
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'is_admin' => $this->input->post('role')
		];

		if (!empty($this->input->post('opd'))) {
			$data = array_merge($data, ['opd' => $this->input->post('opd')]);
		}

		$store = $this->User_model->store($data);

		if ($store) {
			$this->session->set_flashdata('success', 'Berhasil membuat user baru');
			redirect(base_url('user'));
		}
	}

	public function edit($id)
	{
		$user = $this->User_model->getById($id);

		show_page('user/edit', [
			'title' => $user->fullname,
			'user' => $user,
			'opds' => $this->opd_model->getAll()
		]);
	}

	public function update($id)
	{
		$user = $this->User_model->getById($id);

		$this->form_validation->set_rules('nip', 'NIP', 'numeric');
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|max_length[255]');

		if ($user->username !== $this->input->post('username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[255]|is_unique[user.username]');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[255]');
		}

		if ($user->email !== $this->input->post('email')) {
			$this->form_validation->set_rules('email', 'Alamat Email', 'required|max_length[255]|valid_email|is_unique[user.email]');
		} else {
			$this->form_validation->set_rules('email', 'Alamat Email', 'required|max_length[255]|valid_email');
		}

		$this->form_validation->set_rules('password', 'Password', 'max_length[255]');
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'matches[password]');
		}

		if ($this->form_validation->run() == FALSE) {
			return $this->edit($id);
		}

		$data = [
			'id' => $this->input->post('nip'),
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'is_admin' => $this->input->post('role')
		];

		if (!empty($this->input->post('opd'))) {
			$data = array_merge($data, ['opd' => $this->input->post('opd')]);
		}

		if (!empty($this->input->post('password'))) {
			$data = array_merge($data, ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)]);
		}

		$update = $this->User_model->updateById($id, $data);

		if ($update) {
			$this->session->set_flashdata('success', 'Berhasil memperbarui user');
			redirect(base_url("user/edit/$id"));
		}
	}

	public function delete()
	{
		$delete = $this->User_model->deleteById($this->input->post('id'));

		if ($delete) {
			$this->session->set_flashdata('success', 'Berhasil menghapus user');
			redirect(base_url('user'));
		}
	}
}
