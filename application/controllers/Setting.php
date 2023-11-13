<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    unauth_redirect(base_url(''));
    if ($this->session->userdata('username') !== 'admin') {
        redirect('');
    }

    $this->config->load('email');
    $this->config->load('email');
  }

  public function index()
  {
    show_page('setting/index', [
      'title' => 'Pengaturan',
      'smtp_host' => $this->config->item('smtp_host'),
      'smtp_user' => $this->config->item('smtp_user'),
      'smtp_pass' => $this->config->item('smtp_pass'),
      'sender_name' => $this->config->item('sender_name'),
      'mail_subject' => $this->config->item('mail_subject')
    ]);
  }

  public function store()
  {
    $this->load->helper('file');
    $this->config->set_item('smtp_host', htmlspecialchars($this->input->post('smtp_host')));
    $this->config->set_item('smtp_user', htmlspecialchars($this->input->post('smtp_user')));
    $this->config->set_item('sender_name', htmlspecialchars($this->input->post('sender_name')));
    $this->config->set_item('mail_subject', htmlspecialchars($this->input->post('mail_subject')));

    if ($this->input->post('smtp_pass') !== null && !empty($this->input->post('smtp_pass'))) {
      $this->config->set_item('smtp_pass', htmlspecialchars($this->input->post('smtp_pass')));
    }

    $data = "
    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    \$config = array(
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => '" . $this->config->item('smtp_host') . "',
        'smtp_user' => '" . $this->config->item('smtp_user') . "',
        'smtp_pass' => '" . $this->config->item('smtp_pass') . "',
        'smtp_crypto' => 'ssl',
        'smtp_port'   => 465,
        'crlf'    => \"\\r\\n\",
        'newline' => \"\\r\\n\",

        'sender_name' => '" . $this->config->item('sender_name') . "',
        'mail_subject' => '" . $this->config->item('mail_subject') . "'
    );
    ";
    delete_files('./application/config/email.php');
    write_file('./application/config/email.php', $data);
    redirect(base_url('setting'));
  }
}