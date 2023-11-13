<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('show_page')) {
  function show_page($page, $data = [])
  {
    $CI = &get_instance();

    $CI->load->view('layouts/app', array_merge([
      'page' => "pages/$page"
    ], $data));
  }
}
