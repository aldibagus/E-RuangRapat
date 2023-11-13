<form class="row" action="<?= base_url("room/update/$room->id") ?>" method="POST">
  <div class="col-lg-8">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Ubah Data Ruangan</h3>
      </div>
      <div class="card-body">
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <strong>Error!</strong> <?= validation_errors() ?>
        </div>
        <?php endif; ?>
        <?php if($this->session->has_userdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <strong>Sukses!</strong> <?= $this->session->success ?>
        </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="name">Nama Ruangan</label>
          <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= set_value('name', $room->name); ?>" aria-describedby="validationName" placeholder="Nama ruangan" required>
          <div id="validationName" class="invalid-feedback">
            <?= form_error('name'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="number">Kapasitas</label>
          <input type="capacity" class="form-control <?= form_error('capacity') ? 'is-invalid' : '' ?>" id="capacity" name="capacity" value="<?= set_value('capacity', $room->capacity) ?>" aria-describedby="validationCapacity" placeholder="Kapasitas ruangan" required>
          <div id="validationCapacity" class="invalid-feedback">
            <?= form_error('capacity'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-body">
        <button type="submit" class="btn btn-primary btn-block">
          Simpan Ruangan
        </button>
        <a href="<?= base_url('room') ?>" class="btn btn-outline-danger btn-block">
          Batal
        </a>
      </div>
    </div>
  </div>
</form>