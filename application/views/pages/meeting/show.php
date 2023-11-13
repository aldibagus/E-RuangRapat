<div class="row">
  <div class="col-lg-8">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <div class="d-flex align-items-center">
          <h3 class="mb-0">
            <?= $meeting->meeting_title ?>
          </h3>
          <span class="ml-auto badge badge-pill 
                  <?php
                  if ($meeting->accepted == null) {
                    echo 'badge-warning';
                  } elseif ($meeting->accepted == 't') {
                    echo 'badge-success';
                  } else {
                    echo 'badge-danger';
                  }
                  ?>
                  ">
            <?php
            if ($meeting->accepted == null) {
              echo 'Belum diterima';
            } elseif ($meeting->accepted == 't') {
              echo 'Diterima';
            } else {
              echo 'Ditolak';
            }
            ?>
          </span>
        </div>
      </div>
      <div class="card-body">
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger" room_name="alert">
            <strong>Error!</strong> <?= validation_errors() ?>
          </div>
        <?php endif; ?>
        <?php if ($this->session->has_userdata('errors')) : ?>
          <div class="alert alert-danger" room_name="alert">
            <strong>Error!</strong> <?= $this->session->errors ?>
          </div>
        <?php endif; ?>
        <?php if ($this->session->has_userdata('success')) : ?>
          <div class="alert alert-success" role="alert">
            <strong>Sukses!</strong> <?= $this->session->success ?>
          </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="meeting_title">Nama Acara</label>
          <input type="text" class="form-control bg-white" id="meeting_title" name="meeting_title" value="<?= $meeting->meeting_title ?>" readonly>
        </div>
        <div class="form-group">
          <label for="meeting_leader">Pemimpin Acara</label>
          <input type="text" class="form-control bg-white" id="meeting_leader" name="meeting_leader" value="<?= $meeting->meeting_leader ?>" readonly>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" class="form-control bg-white" id="description" rows="5" readonly><?= $meeting->description ?></textarea>
        </div>
        <div class="form-group">
          <label for="meeting_participant">Jumlah Peserta</label>
          <input type="number" min="1" class="form-control bg-white" id="meeting_participant" name="meeting_participant" value="<?= $meeting->meeting_participant ?>" readonly>
        </div>
        <div class="form-group">
          <label for="opd">OPD</label>
          <input type="text" class="form-control bg-white" id="opd" name="opd" value="<?= $meeting->opd_name ?>" readonly>
        </div>
        <div class="form-group">
          <label for="room_name">Ruangan</label>
          <input type="text" class="form-control bg-white" id="room_name" name="room_name" value="<?= $meeting->room_name ?>" readonly>
        </div>
        <div class="form-group">
          <label for="supporting_file">Berkas Pendukung</label>
          <p>
            <?php if ($meeting->supporting_file != null) : ?>
              <a href="<?= base_url("uploads/$meeting->supporting_file") ?>" class="btn btn-sm btn-outline-primary">Unduh</a>
            <?php else : ?>
              <span class="text-sm">Tidak ada berkas</span>
            <?php endif; ?>
          </p>
        </div>
        <div class="form-group">
          <label for="notes">Catatan</label>
          <input type="text" class="form-control bg-white" id="notes" name="notes" value="<?= $meeting->notes ?>" readonly>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card position-sticky top-4">
      <div class="card-body">
        <div class="form-group">
          <label for="start_time">Mulai pada</label>
          <input type="datetime-local" class="form-control bg-white" id="start_time" name="start_time" value="<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->start_time)) ?>" readonly>
        </div>
        <div class="form-group">
          <label for="finish_time">Selesai pada</label>
          <input type="datetime-local" class="form-control bg-white" id="finish_time" name="finish_time" value="<?= mdate('%Y-%m-%dT%H:%i', strtotime($meeting->finish_time)) ?>" readonly>
        </div>
        <?php if (is_admin()): ?>
        <div class="mb-4">
          Nama pemesan rapat: <?= $meeting->user_fullname == null ? $meeting->guest_fullname : $meeting->user_fullname ?>
        </div>
        <?php endif ?>
        <?php if ($meeting->accepted_by_name !== null): ?>
        <div class="mb-4">
          Diterima oleh <?= $meeting->accepted_by_name ?>
        </div>
        <?php endif ?>
        <?php if (is_admin()) : ?>
          <div class="d-flex mx--1 mb-2">
            <div class="flex-grow-1 px-1">
              <form action="<?= base_url("meeting/update/$meeting->id") ?>" method="POST">
                <input type="hidden" name="accepted" value="1">
                <button type="submit" class="btn btn-primary btn-block">
                  Terima
                </button>
              </form>
            </div>
            <div class="flex-grow-1 px-1">
              <form action="<?= base_url("meeting/update/$meeting->id") ?>" method="POST">
                <input type="hidden" name="accepted" value="0">
                <button type="submit" class="btn btn-danger btn-block">
                  Tolak
                </button>
              </form>
            </div>
          </div>
        <?php endif; ?>
        <a href="<?= base_url('meeting') ?>" class="btn btn-outline-danger btn-block">
          Kembali
        </a>
      </div>
    </div>
  </div>
  </form>