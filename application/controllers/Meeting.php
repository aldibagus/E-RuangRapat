<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Meeting_model');
    $this->load->model('Guest_model', 'guest_model');
    $this->load->model('OPD_model', 'opd_model');
    $this->load->model('Room_model', 'room_model');
  }

  public function index()
  {
    $this->load->library('pagination');

    $config['base_url'] = base_url('meeting');
    $config['per_page'] = 10;
    $config['total_rows'] = auth_check() ? $this->Meeting_model->getRowCount($this->input->get('filter'), $this->input->get('search'), is_admin() ? null : user_id()) : $this->Meeting_model->getGuestRowCount();


    $this->pagination->initialize($config);

    $page = $this->input->get('page') ? $this->input->get('page') : 0;
    if (auth_check()) {
      show_page('meeting/index', array_merge(
        [
          'title' => 'Rapat',
          'pagination' => $this->pagination->create_links()
        ],
        is_admin() ? [
          'meetings' => $this->Meeting_model->getFilteredList($config["per_page"], $page, $this->input->get('filter'), $this->input->get('search')),
        ] : [
          'create_url' => base_url('meeting/create'),
          'meetings' => $this->Meeting_model->getFilteredList($config["per_page"], $page, $this->input->get('filter'), $this->input->get('search'), user_id()),
        ]
      ));
    } else {
      show_page('meeting/guest',
        [
          'title' => 'Daftar Acara', 
          'pagination' =>$this->pagination->create_links(),
          'meetings' => $this->Meeting_model->getGuestFilteredList($config['per_page'], $page)
        ]
      );
    }
  }

  public function create()
  {
    if (is_admin()) {
      return redirect('meeting');
    }

    show_page('meeting/create', [
      'title' => 'Pemesanan Ruang Rapat',
      'opds' => $this->opd_model->getAll(),
      'rooms' => $this->room_model->getAll()
    ]);
  }

  public function store()
  {
    if (is_admin()) {
      return redirect('meeting');
    }

    if ($this->form_validation->run('store_meeting') == FALSE) {
      return $this->create();
    }

    $validate = $this->Meeting_model->isNotValidRange(
      $this->input->post('start_time'),
      $this->input->post('finish_time'),
      $this->input->post('room')
    );
    if ($validate) {
      $this->session->set_flashdata('errors', 'Ruangan sedang digunakan pada tanggal tersebut');
      return $this->create();
    }

    if (!empty($_FILES['supporting_file']['name'])) {
      $config = [
        'upload_path' => './uploads/',
        'file_name' => time(),
        'allowed_types' => 'pdf',
        'file_ext_tolower' => true
      ];

      $this->load->library('upload');
      $this->upload->initialize($config);

      if ($this->upload->do_upload('supporting_file')) {
        $file = ['supporting_file' => $this->upload->data('file_name')];
      } else {
        $this->session->set_flashdata('errors', $this->upload->display_errors());
        return $this->create();
      }
    } else {
      $file = [];
    }

    $guest_id = null;
    $store_data = $this->input->post();
    if (!auth_check()) {
      if ($this->form_validation->run('store_guest') == FALSE) {
        return $this->create();
      }

      $guest_id = $this->guest_model->storeOrUpdate([
        'email' => $this->input->post('email'),
        'fullname' => $this->input->post('fullname')
      ]);

      // Remove email and fullname
      array_splice($store_data, 0, 2);
    }

    $store = $this->Meeting_model->store(
      array_merge(
        $store_data,
        [
          'booked_by_user' => user_id(),
          'booked_by_guest' => $guest_id
        ],
        $file
      )
    );

    if ($store) {
      $this->session->set_flashdata('success', 'Berhasil melakukan pemesanan');
      redirect(base_url('meeting'));
    }
  }

  public function show($id)
  {
    unauth_redirect(base_url(''));

    $meeting = $this->Meeting_model->getById($id);

    show_page('meeting/show', [
      'title' => "Rapat #$meeting->id",
      'meeting' => $meeting
    ]);
  }

  public function edit($id)
  {
    unauth_redirect(base_url(''));

    $meeting = $this->Meeting_model->getById($id);

    show_page('meeting/edit', [
      'title' => "Rapat #$meeting->id",
      'meeting' => $meeting,
      'rooms' => $this->room_model->getAll()
    ]);
  }

  public function update($id)
  {
    unauth_redirect(base_url(''));

    $this->load->config('email');
    $this->load->library('email');

    $meeting = $this->Meeting_model->getById($id);

    // Jika update accepted
    $is_acceptance = $this->input->post('accepted') != null;

    // Jika non-admin mencoba accept
    if ($is_acceptance && !is_admin()) {
      redirect(base_url('meeting'));
    }

    // Validasi non-accept
    if (!$is_acceptance && $this->form_validation->run('store_meeting') == FALSE) {
      return $this->edit($id);
    }

    // Validasi range tanggal non-accept
    if (!$is_acceptance && $this->Meeting_model->isNotValidRange($this->input->post('start_time'), $this->input->post('finish_time'))) {
      $this->session->set_flashdata('errors', 'Ruangan sedang digunakan pada tanggal tersebut');
      return $this->edit($id);
    }

    if (!empty($_FILES['supporting_file']['name'])) {
      $config = [
        'upload_path' => './uploads/',
        'file_name' => time(),
        'allowed_types' => 'pdf',
        'file_ext_tolower' => true
      ];

      $this->load->library('upload');
      $this->upload->initialize($config);

      if ($this->upload->do_upload('supporting_file')) {
        $file = ['supporting_file' => $this->upload->data('file_name')];
      } else {
        $this->session->set_flashdata('errors', $this->upload->display_errors());
        return $this->edit($id);
      }
      if ($meeting->supporting_file != null) {
        unlink("./uploads/$meeting->supporting_file");
      }
    } else {
      $file = [];
    }

    if ($is_acceptance) {
      $accepted_by = ['accepted_by' => user_id()];
    }

    $update = $this->Meeting_model->updateById(
      $id,
      array_merge(
        $this->input->post(),
        $file,
        $accepted_by
      )
    );

    if ($update) {
      $this->session->set_flashdata('success', 'Berhasil memperbarui pemesanan');
      if ($is_acceptance) {
        $data = $this->Meeting_model->getById($id);
        $email = $data->email !== null ? $data->email : ($data->user_email == null ? $data->guest_email : $data->user_email);

        if ($email == null || empty($email)) {
          $this->session->set_flashdata('success', 'Berhasil memperbarui pemesanan, namun tidak mengirim surel pemberitahuan');
          redirect(base_url("meeting/show/$id"));
        }

        $message = "
          <table>
            <tr>
              <th colspan=\"3\">Permohonan anda telah " . ($this->input->post('accepted') == true ? 'diterima' : 'ditolak') . " oleh {$data->accepted_by_name}.</th>
            </tr>
            <tr>
              <th colspan=\"3\">Detail ruangan anda sebagai berikut</th>
            </tr>
            <tr>
              <th colspan=\"3\">&nbsp</th>
            </tr>
            <tr>
              <th align=\"left\">Nama Acara</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->meeting_title}</td>
            </tr>
            <tr>
              <th align=\"left\">Pemimpin Acara</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->meeting_leader}</td>
            </tr>
            <tr>
              <th align=\"left\">Deskripsi</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->description}</td>
            </tr>
            <tr>
              <th align=\"left\">Ruangan</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->room_name}</td>
            </tr>
            <tr>
              <th align=\"left\">Jumlah Peserta</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->meeting_participant}</td>
            </tr>
            <tr>
              <th align=\"left\">Dimulai Pada</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->start_time}</td>
            </tr>
            <tr>
              <th align=\"left\">Selesai Pada</th>
              <th>:&nbsp;&nbsp;</th>
              <td>{$data->finish_time}</td>
            </tr>
          </table>
        ";
        $status = send_mail($email, 'Status booking ruangan', $message);
        if (!$status) {
          $this->session->set_flashdata('success', 'Berhasil memperbarui pemesanan, namun gagal mengirim surel pemberitahuan');
        }

        redirect(base_url("meeting/show/$id"));
      } else {
        redirect(base_url("meeting/edit/$id"));
      }
    }
  }

  public function delete()
  {
    admin_redirect('meeting');

    $delete = $this->Meeting_model->deleteById($this->input->post('id'));

    if ($delete) {
      $this->session->set_flashdata('success', 'Berhasil menghapus rapat');
      redirect(base_url('meeting'));
    }
  }

  public function meeting_participant_check($count)
  {
    $this->load->model('Room_model', 'room_model');

    $room_id = $this->input->post('room');
    $room_data = $this->room_model->getById($room_id);

    if ($count > $room_data->capacity) {
      $this->form_validation->set_message(
        'meeting_participant_check',
        "Ruang {$room_data->name} hanya dapat menampung {$room_data->capacity} peserta"
      );
      return false;
    }

    return true;
  }
}
