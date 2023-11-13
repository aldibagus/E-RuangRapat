<?php
$this->load->view('layouts/head');
?>

<body>
  <!-- Sidenav -->
  <?php
  if (auth_check()) {
    $this->load->view('components/sidenav');
  }
  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php
    if (auth_check()) {
      $this->load->view('components/topnav');
    }
    ?>
    <!-- Header -->
    <?php
    $this->load->view('components/header');
    ?>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <?php
      $this->load->view($page);
      ?>
    </div>
  </div>
  <?php
  $this->load->view('layouts/js');
  ?>

</body>