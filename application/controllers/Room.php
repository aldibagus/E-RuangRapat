<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		user_redirect(base_url('dashboard'));
		$this->load->model('Room_model', 'room_model');
	}

	public function index()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url('room');
		$config['per_page'] = 10;
		$config['total_rows'] = $this->room_model->count();

		$this->pagination->initialize($config);

		$page = $this->input->get('page') ? $this->input->get('page') : 0;

		show_page('room/index', [
			'title' => 'Room',
			'create_url' => base_url('room/create'),
			'rooms' => $this->room_model->getList($config["per_page"], $page),
			'pagination' => $this->pagination->create_links()
		]);
	}

	public function create()
	{
		show_page('room/create', [
			'title' => 'Buat Ruangan',
			'rooms' => $this->room_model->getAll()
		]);
	}

	public function store()
	{
		if ($this->form_validation->run('store_room') == FALSE) {
			return $this->create();
		}

		$store = $this->room_model->store([
			// 'parent_id' => $this->input->post('parent_id'),
			'name' => $this->input->post('name'),
			'capacity' => $this->input->post('capacity')
		]);

		if ($store) {
			$this->session->set_flashdata('success', 'Berhasil membuat ruangan baru');
			redirect(base_url('room'));
		}
	}

	public function edit($id)
	{
		$room = $this->room_model->getById($id);

		show_page('room/edit', [
			'title' => $room->name,
			'rooms' => $this->room_model->getAll(),
			'room' => $room
		]);
	}

	public function update($id)
	{
		$room = $this->room_model->getById($id);

		$update = $this->room_model->updateById($id, [
			// 'parent_id' => $this->input->post('parent_id'),
			'name' => $this->input->post('name'),
			'capacity' => $this->input->post('capacity')
		]);

		if ($update) {
			$this->session->set_flashdata('success', 'Berhasil memperbarui ruangan');
			redirect(base_url("room/edit/$id"));
		}
	}

	public function delete()
	{
		$delete = $this->room_model->deleteById($this->input->post('id'));

		if ($delete) {
			$this->session->set_flashdata('success', 'Berhasil menghapus ruangan');
			redirect(base_url('room'));
		}
	}
}
