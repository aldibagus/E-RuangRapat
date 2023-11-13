<form class="row" action="<?= base_url("meeting/update/$meeting->id") ?>" method="POST" enctype="multipart/form-data">
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
          <label for="email">Alamat E-Mail</label>
          <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email', $meeting->email); ?>" aria-describedby="validationMeetingEmail" placeholder="Alamat surel pemohon" required>
          <div id="validationMeetingEmail" class="invalid-feedback">
            <?= form_error('email'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_title">Nama Acara</label>
          <input type="text" class="form-control <?= form_error('meeting_title') ? 'is-invalid' : '' ?>" id="meeting_title" name="meeting_title" value="<?= set_value('meeting_title', $meeting->meeting_title); ?>" aria-describedby="validationMeetingTitle" placeholder="Topik Pembahasan Rapat" required>
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('meeting_title'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_leader">Pemimpin Acara</label>
          <input type="text" class="form-control <?= form_error('meeting_leader') ? 'is-invalid' : '' ?>" id="meeting_leader" name="meeting_leader" value="<?= set_value('meeting_leader'); ?>" aria-describedby="validationMeetingTitle" placeholder="Pemimpin Acara Yang Dimohon" required>
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('meeting_leader'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" class="form-control <?= form_error('description') ? 'is-invalid' : '' ?>" id="description" rows="5" aria-describedby="validationDescription" placeholder="Deskripsi Tentang Rapat" required><?= set_value('description', $meeting->description); ?></textarea>
          <div id="validationDescription" class="invalid-feedback">
            <?= form_error('description'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_participant">Jumlah Peserta</label>
          <input type="number" min="1" class="form-control <?= form_error('meeting_participant') ? 'is-invalid' : '' ?>" id="meeting_participant" name="meeting_participant" value="<?= set_value('meeting_participant', $meeting->meeting_participant); ?>" aria-describedby="validationMeetingParticipant" required>
          <div id="validationMeetingParticipant" class="invalid-feedback">
            <?= form_error('meeting_participant'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="room">Ruangan</label>
          <select class="form-control <?= form_error('room') ? 'is-invalid' : '' ?>" id="room" name="room" aria-describedby="validationRoom" required>
            <option value="" <?= set_select('room', '', TRUE); ?> disabled>Pilih Ruangan</option>
            <?php foreach ($rooms as $room) : ?>
              <option value="<?= $room->id ?>" <?= set_select('room', $room->id) ?>><?= $room->name ?></option>
            <?php endforeach ?>
          </select>
          <div id="validationRoomName" class="invalid-feedback">
            <?= form_error('room'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="supporting_file">Berkas Pendukung</label>
          <?php if ($meeting->supporting_file != null):?>
            <a href="<?= base_url("uploads/$meeting->supporting_file") ?>" class="btn btn-sm ml-3 btn-outline-primary">Unduh</a>
          <?php else: ?>
            <span class="text-sm">Tidak ada berkas</span>
          <?php endif; ?>
          <div class="custom-file">
            <input accept="application/pdf" type="file" class="custom-file-input <?= form_error('supporting_file') ? 'is-invalid' : '' ?>" name="supporting_file" id="supporting_file" aria-describedby="validationSupportingFile">
            <label class="custom-file-label" for="supporting_file">Pilih file</label>
            <div id="validationSupportingFile" class="invalid-feedback">
              <?= form_error('supporting_file'); ?>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="notes">Catatan</label>
          <input type="text" class="form-control <?= form_error('notes') ? 'is-invalid' : '' ?>" id="notes" name="notes" value="<?= set_value('notes'); ?>" aria-describedby="validationMeetingTitle" placeholder="Contoh: Perlu 3 kabel proyektor">
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('notes'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card position-sticky top-4">
      <div class="card-body">
        <div class="form-group">
          <label for="start_time">Mulai pada</label>
          <input type="datetime-local" class="form-control <?= form_error('start_time') ? 'is-invalid' : '' ?>" id="start_time" name="start_time" value="<?= set_value('start_time', mdate('%Y-%m-%dT%H:%i', strtotime($meeting->start_time))); ?>" aria-describedby="validationStartTime" required>
          <div id="validationStartTime" class="invalid-feedback">
            <?= form_error('start_time'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="finish_time">Selesai pada</label>
          <input type="datetime-local" class="form-control <?= form_error('finish_time') ? 'is-invalid' : '' ?>" id="finish_time" name="finish_time" value="<?= set_value('finish_time', mdate('%Y-%m-%dT%H:%i', strtotime($meeting->finish_time))); ?>" aria-describedby="validationFinishTime" required>
          <div id="validationFinishTime" class="invalid-feedback">
            <?= form_error('finish_time'); ?>
          </div>
        </div>
        <div class="mb-4">
          Dibooking oleh <?= $meeting->user_fullname == null ? $meeting->guest_fullname : $meeting->user_fullname ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          Perbarui Pesanan
        </button>
        <a href="<?= base_url('meeting') ?>" class="btn btn-outline-danger btn-block">
          Kembali
        </a>
      </div>
    </div>
  </div>
</form>

<script>
  $('#room').on('change', function() {
    img = document.createElement('img');
    img.style = "width: 100%";
    img.src = "<?= base_url('uploads/') ?>" + $(this).find('option:selected').text() + ".jpg";
    $('#room_visualization').html(img);
  })
  
  $('#start_picker').dateTimePicker();
  $('#finish_picker').dateTimePicker();
</script>