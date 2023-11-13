<form class="row" action="<?= base_url('meeting/store') ?>" method="POST" enctype="multipart/form-data">
  <div class="col-lg-8">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Pesan Ruang Rapat</h3>
      </div>
      <div class="card-body">
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?= validation_errors() ?>
          </div>
        <?php endif; ?>
        <?php if ($this->session->has_userdata('errors')) : ?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?= $this->session->errors ?>
          </div>
        <?php endif; ?>
        <?php if(!auth_check()): ?>
        <div class="form-group">
          <label for="fullname">Nama Pemohon</label>
          <input type="text" class="form-control <?= form_error('fullname') ? 'is-invalid' : '' ?>" id="fullname" name="fullname" value="<?= set_value('fullname'); ?>" aria-describedby="validationMeetingTitle" placeholder="Nama lengkap pemohon" required>
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('fullname'); ?>
          </div>
        </div>
        <?php endif ?>
        <div class="form-group">
          <label for="email">Alamat E-Mail</label>
          <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email'); ?>" aria-describedby="validationMeetingTitle" placeholder="Alamat surel pemohon" required>
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('email'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_title">Nama Acara</label>
          <input type="text" class="form-control <?= form_error('meeting_title') ? 'is-invalid' : '' ?>" id="meeting_title" name="meeting_title" value="<?= set_value('meeting_title'); ?>" aria-describedby="validationMeetingTitle" placeholder="Topik Pembahasan Rapat" required>
          <div id="validationMeetingTitle" class="invalid-feedback">
            <?= form_error('meeting_title'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_leader">Pemimpin Acara</label>
          <input type="text" class="form-control <?= form_error('meeting_leader') ? 'is-invalid' : '' ?>" id="meeting_leader" name="meeting_leader" value="<?= set_value('meeting_leader'); ?>" aria-describedby="validationMeetingLeader" placeholder="Pemimpin Acara Yang Dimohon" required>
          <div id="validationMeetingLeader" class="invalid-feedback">
            <?= form_error('meeting_leader'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" class="form-control <?= form_error('description') ? 'is-invalid' : '' ?>" id="description" rows="5" aria-describedby="validationDescription" placeholder="Deskripsi Tentang Rapat" required><?= set_value('description'); ?></textarea>
          <div id="validationDescription" class="invalid-feedback">
            <?= form_error('description'); ?>
          </div>
        </div>
        <?php if(!auth_check()): ?>
        <div class="form-group">
          <label for="opd">OPD</label>
          <input type="text" class="form-control <?= form_error('opd') ? 'is-invalid' : '' ?>" id="opd" name="opd" value="<?= set_value('opd'); ?>" aria-describedby="validationOPD" placeholder="OPD" required>
          <div id="validationOPD" class="invalid-feedback">
            <?= form_error('opd'); ?>
          </div>
        </div>
        <?php endif ?>
        <div class="form-group">
          <label for="room">Ruangan</label>
          <select class="form-control <?= form_error('room') ? 'is-invalid' : '' ?>" id="room" name="room" aria-describedby="validationRoom" required>
            <option value="" <?= set_select('room', '', TRUE); ?> disabled>Pilih Ruangan</option>
            <?php foreach ($rooms as $room) : ?>
              <option value="<?= $room->id ?>" <?= set_select('room', $room->name) ?>><?= $room->name ?></option>
            <?php endforeach ?>
          </select>
          <div id="validationRoomName" class="invalid-feedback">
            <?= form_error('room'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="meeting_participant">Jumlah Peserta</label>
          <input type="number" min="1" class="form-control <?= form_error('meeting_participant') ? 'is-invalid' : '' ?>" id="meeting_participant" name="meeting_participant" value="<?= set_value('meeting_participant', 1); ?>" aria-describedby="validationMeetingParticipant" required>
          <div id="validationMeetingParticipant" class="invalid-feedback">
            <?= form_error('meeting_participant'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="supporting_file">Berkas Pendukung</label>
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
          <div id="start_picker"> </div>
          <input type="hidden" id="start_result" name="start_time" value="" />
          <!-- <input type="datetime-local" class="form-control <?= form_error('start_time') ? 'is-invalid' : '' ?>" id="start_time" name="start_time" value="<?= set_value('start_time'); ?>" aria-describedby="validationStartTime" required> -->
          <div id="validationStartTime" class="invalid-feedback">
            <?= form_error('start_time'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="finish_time">Selesai pada</label>
          <div id="finish_picker" class=""> </div>
          <input type="hidden" id="finish_result" name="finish_time" value="" />
          <!-- <input type="datetime-local" class="form-control <?= form_error('finish_time') ? 'is-invalid' : '' ?>" id="finish_time" name="finish_time" value="<?= set_value('finish_time'); ?>" aria-describedby="validationFinishTime" required> -->
          <div id="validationFinishTime" class="invalid-feedback">
            <?= form_error('finish_time'); ?>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          Kirim Pesanan
        </button>
        <a href="<?= base_url('meeting') ?>" class="btn btn-outline-danger btn-block">
          Kembali
        </a>
      </div>
      <div class="card-footer" id="room_visualization">
        <img id="room_visualization" src="" style="width: 100%">
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