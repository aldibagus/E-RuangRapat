<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>E-Ruang Rapat</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/kota_madiun.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/icofont/icofont.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/owl.carousel/owl.carousel.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/venobox/venobox.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/aos/aos.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fullcalendar/fullcalendar.min.css') ?>">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/home.css') ?>" rel="stylesheet">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
      background-color: #5777ba;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      opacity: 0.8;
    }

    /* for guest btn */
    .guest-btn{
      background-color: #5777ba;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      display:inline-block;
      width: 100%;
      text-align:center;
    }

    .guest-txt-color-white{
      color: #ffffff !important;  
      
    }
    
    /* Extra styles for the cancel button */
    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
      position: relative;
    }

    img.avatar {
      width: 10%;
      border-radius: 30%;
    }

    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
      padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 5% auto 15% auto;
      /* 5% from the top, 15% from the bottom and centered */
      border: 1px solid #888;
      width: 80%;
      /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
      position: absolute;
      right: 25px;
      top: 0;
      color: #000;
      font-size: 35px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: red;
      cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
      -webkit-animation: animatezoom 0.6s;
      animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
      from {
        -webkit-transform: scale(0)
      }

      to {
        -webkit-transform: scale(1)
      }
    }

    @keyframes animatezoom {
      from {
        transform: scale(0)
      }

      to {
        transform: scale(1)
      }
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>

  <!-- =======================================================
  * Template Name: Appland - v2.2.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">E-Ruang Rapat</a></h1>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="#jadwal">Lihat Jadwal</a></li>

          <?php if (auth_check()) : ?>
            <li class="get-started"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
          <?php else : ?>
            <li onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="get-started">
              <a href="#">LOGIN</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
            
  </header><!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container">
    <!-- <?php if($this->session->flashdata('success')) :?>
      <div id="success" class="alert alert-success" >
        <strong>Sukses!</strong> <?= $this->session->flashdata('success') ?>
      </div>
    <?php endif;?> -->
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
          <div>
            <h1>E-Ruang Rapat Kota Madiun</h1>
            <h2>E-Ruang rapat aplikasi berbasis website yang digunakan untuk booking ruang rapat yang berada pada gedung GCIO </h2>
            <a href="#jadwal" class="download-btn"><i class="bx bxl-play-store"></i> Lihat Jadwal</a>
          </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-center order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="<?= base_url('assets/img/kota_madiun.png') ?>" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= App Features Section ======= -->
    <section id="jadwal" class="features">
      <div class="container">
        <div id="calendar"></div>
      </div>
    </section><!-- End App Features Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Kontak</h2>

        </div>

        <div class="row">

          <div class="col-md-12">
            <div class="row">
              <div class="col-lg-6 info" data-aos="fade-up">
                <i class="bx bx-map"></i>
                <h4>Address</h4>
                <p>Jl.Periintis Kemerdekaan No.32<br>Madiun</p>
              </div>
              <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-phone"></i>
                <h4>Call Us</h4>
                <p>(0351) 467327</p>
              </div>
              <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-envelope"></i>
                <h4>Email Us</h4>
                <p>contact@example.com<br>info@example.com</p>
              </div>
              <div class="col-lg-6 info" data-aos="fade-up" data-aos-delay="300">
                <i class="bx bx-time-five"></i>
                <h4>Working Hours</h4>
                <p>Senin-Kamis: 9AM to 3PM<br>Jumat: 9AM to 1PM</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>DISKOMINFO KOTA MADIUN</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="id01" class="modal" tabindex="-1" role="dialog" style="z-index: 2147483647;">
    <!--LOGIN AREA-->
    <div class="modal-dialog modal-xl">
      <!-- admin form -->
      <form class="modal-content animate" action="/auth" method="post">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
          <img src="<?= base_url('assets/img/kota_madiun.png') ?>" alt="Avatar" class="avatar">
        </div>

        <div class="container">
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>

          <button type="submit">Login</button>  
          <a class="guest-btn guest-txt-color-white"href="<?= base_url('meeting/create') ?>">Guest</a>
          <!-- <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
          </label> -->
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="scheduleModal" style="z-index: 2147483647;" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scheduleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="meeting_title">Judul Rapat</label>
            <input type="text" class="form-control bg-white" id="meeting_title" name="meeting_title" readonly>
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control bg-white" id="description" rows="5" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="start_time">Mulai pada</label>
            <input type="text" class="form-control bg-white" id="start_time" name="start_time" readonly>
          </div>
          <div class="form-group">
            <label for="finish_time">Selesai pada</label>
            <input type="text" class="form-control bg-white" id="finish_time" name="finish_time" readonly>
          </div>
          <div class="form-group">
            <label for="meeting_participant">Jumlah Peserta</label>
            <input type="number" min="1" class="form-control bg-white" id="meeting_participant" name="meeting_participant" readonly>
          </div>
          <div class="form-group">
            <label for="room_name">Ruangan</label>
            <input type="text" class="form-control bg-white" id="room_name" name="room_name" readonly>
          </div>
          <div class="form-group">
            <label for="room_name">Dibooking oleh</label>
            <input type="text" class="form-control bg-white" id="booker" name="booker" readonly>
          </div>
          <div class="form-group">
            <label for="supporting_file">Berkas Pendukung</label>
            <p>
              <a id="supporting_file"></a>
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/owl.carousel/owl.carousel.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/venobox/venobox.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/fullcalendar/fullcalendar.min.js') ?>"></script>
  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    $('#id01 form').on('submit', function(event) {
      event.preventDefault();
      $.post('<?= base_url('auth') ?>', $(this).serialize(), function(data) {
        if (data) {
          window.location = '<?= base_url('schedule') ?>';
        } else {
          alert('Nama pengguna atau kata sandi salah');
        }
      })
    })
  </script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/home.js') ?>"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        events: [
          <?php
          foreach ($meetings as $meeting) :
          ?> {
              id: '<?= $meeting->id ?>',
              title: '<?= $meeting->meeting_title ?>',
              start: '<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->start_time)) ?>',
              end: '<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->finish_time)) ?>',
              extendedProps: {
                booker: '<?= $meeting->user_fullname === null ? $meeting->guest_fullname : $meeting->user_fullname ?>',
                meeting_participant: '<?= $meeting->meeting_participant ?>',
                room_name: '<?= $meeting->room_name ?>',
                description: '<?= $meeting->description ?>',
                supporting_file: '<?= $meeting->supporting_file ?>'
              }
            },
          <?php
          endforeach;
          ?>
        ],
        eventClick: function(info) {
          const modal = $('#scheduleModal');
          modal.find('.modal-title').text(`Rapat #${info.event.id}`);
          modal.find('#meeting_title').val(info.event.title);
          modal.find('#start_time').val(info.event.start);
          modal.find('#finish_time').val(info.event.end);
          modal.find('#meeting_participant').val(info.event.extendedProps.meeting_participant);
          modal.find('#booker').val(info.event.extendedProps.booker);
          modal.find('#room_name').val(info.event.extendedProps.room_name);
          modal.find('#description').val(info.event.extendedProps.description);
          if (info.event.extendedProps.supporting_file != '') {
            modal.find('#supporting_file').text('Unduh');
            modal.find('#supporting_file').addClass('btn btn-sm btn-outline-primary');
            modal.find('#supporting_file').attr('href', `<?= base_url('uploads') ?>/${info.event.extendedProps.supporting_file}`);
          } else {
            modal.find('#supporting_file').text('Tidak ada berkas');
            modal.find('#supporting_file').removeClass('btn btn-sm btn-outline-primary');
            modal.find('#supporting_file').removeAttr('href');
          }

          modal.modal('show');
        }
      });
      calendar.render();


    });
  </script>
</body>

</html>