<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('send_mail')) {
  function send_mail($recipent, $subject, $message)
  {
    $CI = &get_instance();

    $CI->load->config('email');
    $CI->load->library('email');

    $CI->email->from($CI->config->item('smtp_user'), $CI->config->item('sender_name'));
    $CI->email->to($recipent);
    $CI->email->subject($subject);
    $CI->email->message($message);

    return $CI->email->send();
  }
}
