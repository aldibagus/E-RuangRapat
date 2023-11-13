<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
        if ($this->form_validation->run('auth_user') == FALSE) {
            return;
        }

        $validate = $this->db
            ->select('user.*')
			->select('opd.name')
			->from('user')
			->join('opd', 'opd.id = user.opd', 'LEFT')
			->where('username', $this->input->post('username'))
			->or_where('user.id', $this->input->post('username'))
            ->get()
            ->row();
            
        if ($validate) {
            if (password_verify($this->input->post('password'), $validate->password)) {
                $data = [
                    'user_id' => $validate->id,
                    'fullname' => $validate->fullname,
                    'username' => $validate->username,
                    'opd' => $validate->opd,
                    'opd_name' => $validate->name,
                    'is_admin' => $validate->is_admin == 't' || $validate->is_admin === 1
                ];

                $this->session->set_userdata($data);
                // redirect(base_url('user'));
                echo true;
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('opd');
        $this->session->unset_userdata('opd_name');
        $this->session->unset_userdata('is_admin');

        redirect(base_url());
    }
}
