<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('auth_check')) {
  function auth_check()
  {
    $CI = &get_instance();
    return $CI->session->has_userdata('username');
  }
}

if (!function_exists('unauth_redirect')) {
  function unauth_redirect($url)
  {
    if(!auth_check()) {
      return redirect($url);
    }
  }
}

if (!function_exists('user_id')) {
  function user_id()
  {
    $CI = &get_instance();
    return $CI->session->userdata('user_id');
  }
}

if (!function_exists('is_admin')) {
  function is_admin()
  {
    $CI = &get_instance();
    return $CI->session->userdata('is_admin');
  }
}

if (!function_exists('user_redirect')) {
  function user_redirect($url)
  {
    unauth_redirect($url);
    if(!is_admin()) {
      return redirect($url);
    }
  }
}

if (!function_exists('admin_redirect')) {
  function admin_redirect($url)
  {
    unauth_redirect($url);
    if(is_admin()) {
      return redirect($url);
    }
  }
}