<form class="row" action="<?= base_url('user/store') ?>" method="POST">
  <div class="col-lg-8">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Tambah User Baru</h3>
      </div>
      <div class="card-body">
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <strong>Error!</strong> <?= validation_errors() ?>
        </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : '' ?>" id="nip" name="nip" value="<?= set_value('nip'); ?>" aria-describedby="validationNIP" placeholder="Nomor Induk Pegawai" required>
          <div id="validationNIP" class="invalid-feedback">
            <?= form_error('nip'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="fullname">Nama lengkap</label>
          <input type="text" class="form-control <?= form_error('fullname') ? 'is-invalid' : '' ?>" id="fullname" name="fullname" value="<?= set_value('fullname'); ?>" aria-describedby="validationFullname" placeholder="Nama Lengkap" required>
          <div id="validationFullname" class="invalid-feedback">
            <?= form_error('fullname'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="email">Alamat E-Mail</label>
          <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= set_value('email'); ?>" aria-describedby="validationEmail" placeholder="Nomor Induk Pegawai" required>
          <div id="validationEmail" class="invalid-feedback">
            <?= form_error('email'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= set_value('username'); ?>" aria-describedby="validationUsername" placeholder="Username untuk login" required>
          <div id="validationUsername" class="invalid-feedback">
            <?= form_error('username'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="password">Kata sandi</label>
          <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" id="password" name="password" minlength="8" aria-describedby="validationPassword" placeholder="Isi password" required>
          <div id="validationPassword" class="invalid-feedback">
            <?= form_error('password'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="password_confirm">Konfirmasi kata sandi</label>
          <input type="password" class="form-control <?= form_error('password_confirm') ? 'is-invalid' : '' ?>" id="password_confirm" name="password_confirm" minlength="8" aria-describedby="validationPasswordConfirm" placeholder="Konfirmasi" required>
          <div id="validationPasswordConfirm" class="invalid-feedback">
            <?= form_error('password_confirm'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="opd">OPD</label>
          <select class="form-control" id="opd" name="opd" aria-describedby="validationRole" required>
            <option value="" <?= set_select('opd', ''); ?> disabled>Pilih OPD</option>
            <option value="">Tidak punya OPD</option>
            <?php foreach ($opds as $opd) : ?>
              <option value="<?= $opd->id ?>" <?= set_select('opd', $opd->id) ?>><?= $opd->name ?></option>
            <?php endforeach ?>
          </select>
          <div id="validationRole" class="invalid-feedback">
            <?= form_error('opd'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control <?= form_error('role') ? 'is-invalid' : '' ?>" id="role" name="role" aria-describedby="validationRole" required>
            <option value="" <?= set_select('role', '', TRUE); ?> disabled>Pilih Role</option>
            <option value="0" <?= set_select('role', 0); ?>>User</option>
            <option value="1" <?= set_select('role', 1); ?>>Admin</option>
          </select>
          <div id="validationRole" class="invalid-feedback">
            <?= form_error('role'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card position-sticky top-4">
      <div class="card-body">
        <button type="submit" class="btn btn-primary btn-block">
          Simpan User
        </button>
        <a href="<?= base_url('user') ?>" class="btn btn-outline-danger btn-block">
          Batal
        </a>
      </div>
    </div>
  </div>
</form>