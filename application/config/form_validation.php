<?php

$config = [
  'auth_user' => [
    [
      'field' => 'username',
      'label' => 'Nama pengguna',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'password',
      'label' => 'Kata sandi',
      'rules' => 'required|max_length[255]'
    ]
  ],
  'store_user' => [
    [
      'field' => 'fullname',
      'label' => 'Nama lengkap',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'nip',
      'label' => 'NIP',
      'rules' => 'numeric|is_unique[user.id]'
    ],
    [
      'field' => 'email',
      'label' => 'Alamat Email',
      'rules' => 'required|max_length[255]|valid_email|is_unique[user.email]'
    ],
    [
      'field' => 'username',
      'label' => 'Nama pengguna',
      'rules' => 'required|max_length[255]|is_unique[user.username]'
    ],
    [
      'field' => 'password',
      'label' => 'Kata sandi',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'password_confirm',
      'label' => 'Konfirmasi kata sandi',
      'rules' => 'required|matches[password]'
    ],
    [
      'field' => 'opd',
      'label' => 'OPD',
      'rules' => ''
    ],
    [
      'field' => 'role',
      'label' => 'Hak akses',
      'rules' => 'required|in_list[0,1]'
    ]
  ],
  'store_room' => [
    [
      'field' => 'name',
      'label' => 'Nama Ruangan',
      'rules' => 'required|max_length[255]|is_unique[room.name]'
    ],
    [
      'field' => 'capacity',
      'label' => 'Kapasitas Ruangan',
      'rules' => 'required|numeric|greater_than_equal_to[1]'
    ]
  ],
  'store_guest' => [
    [
      'field' => 'email',
      'label' => 'Alamat E-Mail',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'fullname',
      'label' => 'Nama Pemohon',
      'rules' => 'required|max_length[255]'
    ]
  ],
  'store_meeting' => [
    [
      'field' => 'meeting_title',
      'label' => 'Judul Rapat',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'meeting_leader',
      'label' => 'Pemimpin Acara',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'description',
      'label' => 'Deskripsi',
      'rules' => 'required'
    ],
    [
      'field' => 'meeting_participant',
      'label' => 'Jumlah Peserta',
      'rules' => 'required|numeric|greater_than_equal_to[1]|callback_meeting_participant_check'
    ],
    [
      'field' => 'opd',
      'label' => 'OPD',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'room',
      'label' => 'Ruangan',
      'rules' => 'required|numeric'
    ],
    [
      'field' => 'start_time',
      'label' => 'Waktu Mulai',
      'rules' => 'required'
    ],
    [
      'field' => 'finish_time',
      'label' => 'Waktu Selesai',
      'rules' => 'required'
    ],
    [
      'field' => 'supporting_file',
      'label' => 'Berkas Pendukung',
      'rules' => ''
    ],
    [
      'field' => 'notes',
      'label' => 'Catatan',
      'rules' => ''
    ]
  ]
];
