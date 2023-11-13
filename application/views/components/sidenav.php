<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center" style="height: 160px;">
      <a class="navbar-brand" href="javascript:void(0)">
        E-Ruang Rapat        
        <br><img src="<?= base_url('/assets/img/madiun.png') ?>" class="navbar-brand-img" alt="..." style="max-height: 100px">

      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'schedule' ? 'active' : '' ?>" href="<?= base_url('schedule') ?>">
              <i class="ni ni-calendar-grid-58 <?= $this->uri->segment(1) == 'schedule' ? 'text-primary' : '' ?>"></i>
              <span class="nav-link-text">Daftar Jadwal</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'meeting' ? 'active' : '' ?>" href="<?= base_url('meeting') ?>">
              <i class="ni ni-briefcase-24 <?= $this->uri->segment(1) == 'meeting' ? 'text-primary' : '' ?>"></i>
              <span class="nav-link-text">Daftar Rapat</span>
            </a>
          </li>
          <?php if (is_admin()): ?>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>" href="<?= base_url('user') ?>">
              <i class="ni ni-single-02 <?= $this->uri->segment(1) == 'user' ? 'text-primary' : '' ?>"></i>
              <span class="nav-link-text">Daftar Pengguna</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'room' ? 'active' : '' ?>" href="<?= base_url('room') ?>">
              <i class="ni ni-building <?= $this->uri->segment(1) == 'room' ? 'text-primary' : '' ?>"></i>
              <span class="nav-link-text">Daftar Ruangan</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if (is_admin() && $this->session->userdata('username') === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'setting' ? 'active' : '' ?>" href="<?= base_url('setting') ?>">
              <i class="ni ni-settings-gear-65 <?= $this->uri->segment(1) == 'room' ? 'text-primary' : '' ?>"></i>
              <span class="nav-link-text">Pengaturan</span>
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</nav>