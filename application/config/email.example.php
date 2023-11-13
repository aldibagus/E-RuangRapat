<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'protocol'  => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_user' => 'email@gmail.com',   // Email Username
    'smtp_pass' => 'password',          // Email Password
    'smtp_crypto' => 'ssl',
    'smtp_port'   => 465,
    'crlf'    => "\r\n",
    'newline' => "\r\n",

    'sender_name' => 'E-Ruang Rapat',
    'mail_subject' => 'Status booking ruang rapat'
);
