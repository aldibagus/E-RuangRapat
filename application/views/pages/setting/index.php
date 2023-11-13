<form class="row" action="<?= base_url('setting/store') ?>" method="POST">
  <div class="col-lg-8">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Pengaturan Aplikasi</h3>
      </div>
      <div class="card-body">
        <?php if(validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <strong>Error!</strong> <?= validation_errors() ?>
        </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="smtp_host">SMTP Host</label>
          <input type="text" class="form-control <?= form_error('smtp_host') ? 'is-invalid' : '' ?>" id="smtp_host" name="smtp_host" value="<?= set_value('smtp_host', $smtp_host); ?>" aria-describedby="validationSMTPHost" required>
          <div id="validationSMTPHost" class="invalid-feedback">
            <?= form_error('smtp_host'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_user">SMTP User</label>
          <input type="text" class="form-control <?= form_error('smtp_user') ? 'is-invalid' : '' ?>" id="smtp_user" name="smtp_user" value="<?= set_value('smtp_user', $smtp_user); ?>" aria-describedby="validationSMTPUser" required>
          <div id="validationSMTPUser" class="invalid-feedback">
            <?= form_error('smtp_user'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="smtp_pass">SMTP Password</label>
          <input type="password" class="form-control <?= form_error('smtp_pass') ? 'is-invalid' : '' ?>" id="smtp_pass" name="smtp_pass" aria-describedby="validationSMTPPass" placeholder="Jangan diisi jika tidak mau mengubah">
          <div id="validationSMTPPass" class="invalid-feedback">
            <?= form_error('smtp_pass'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="sender_name">Sender Name</label>
          <input type="text" class="form-control <?= form_error('sender_name') ? 'is-invalid' : '' ?>" id="sender_name" name="sender_name" value="<?= set_value('sender_name', $sender_name); ?>" aria-describedby="validationSenderName" required>
          <div id="validationSenderName" class="invalid-feedback">
            <?= form_error('sender_name'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="mail_subject">Mail Subject</label>
          <input type="text" class="form-control <?= form_error('mail_subject') ? 'is-invalid' : '' ?>" id="mail_subject" name="mail_subject" value="<?= set_value('mail_subject', $mail_subject); ?>" aria-describedby="validationMailSubject" required>
          <div id="validationMailSubject" class="invalid-feedback">
            <?= form_error('mail_subject'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card position-sticky top-4">
      <div class="card-body">
        <span>Simpan perubahan mungkin memerlukan beberapa detik</span><br><br>
        <button type="submit" class="btn btn-primary btn-block">
          Simpan Pengaturan
        </button>
        <a href="<?= base_url('schedule') ?>" class="btn btn-outline-danger btn-block">
          Batal
        </a>
      </div>
    </div>
  </div>
</form>