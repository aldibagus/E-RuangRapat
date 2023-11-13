<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Aplikasi Ruangan</title>
  <!-- Favicon -->
  <link rel="icon" href="<?= base_url('/assets/img/brand/favicon.png') ?>" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/nucleo/css/nucleo.css') ?>" type="text/css">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/argon.min.css?v=1.2.0') ?>" type="text/css">
  <?php 
    if ($this->uri->segment(1) === 'schedule'):
  ?>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fullcalendar/fullcalendar.min.css') ?>" type="text/css">
    <script src="<?= base_url('assets/vendor/fullcalendar/fullcalendar.min.js') ?>"></script>
  <?php
    endif;
  ?>
  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <?php if ($this->uri->segment(1) === 'meeting' && ($this->uri->segment(2) === 'create' || $this->uri->segment(2) === 'edit' || $this->uri->segment(2) === 'store')): ?>
  <link rel="stylesheet" href="<?= base_url('assets/css/datetimepicker.css') ?>">
  <script src="<?= base_url('assets/js/moment-with-locales.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/datetimepicker.js') ?>"></script>
  <?php endif ?>
</head>