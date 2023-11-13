<div class="row">
  <div class="col">
    <?php if ($this->session->has_userdata('success')) : ?>
      <div class="alert alert-success" role="alert">
        <strong>Sukses!</strong> <?= $this->session->success ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">Daftar User</h3>
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="nip">NIP</th>
              <th scope="col" class="sort" data-sort="fullname">Nama lengkap</th>
              <th scope="col" class="sort" data-sort="username">Nama pengguna</th>
              <th scope="col" class="sort" data-sort="opd">OPD</th>
              <th scope="col" class="sort" data-sort="role">Jabatan</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            <?php
            foreach ($users as $user) :
            ?>
              <tr>
                <td>
                  <?= $user->id ?>
                </td>
                <td>
                  <?= $user->fullname ?>
                </td>
                <td>
                  <?= $user->username ?>
                </td>
                <td>
                  <?= $user->opd_name ?>
                </td>
                <td>
                  <?= $user->is_admin == 't' ? 'Admin' : 'User' ?>
                </td>
                <td class="text-right">
                  <a href="<?= base_url("user/edit/$user->id") ?>" class="btn btn-outline-primary">Edit</a>
                  <button type="button" class="btn btn-outline-danger" data-id="<?= $user->id ?>" data-toggle="modal" data-target="#deletionModal">
                    Hapus
                  </button>
                </td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
      <!-- Card footer -->
      <div class="card-footer py-4">
        <?= $pagination ?>
      </div>
    </div>
  </div>
</div>
<!-- Deletion Modal -->
<div class="modal fade" id="deletionModal" tabindex="-1" role="dialog" aria-labelledby="deletionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletionModalLabel">Hapus User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus user ini? User akan dihapus secara permanen dan tidak dapat kembali
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('user/delete') ?>" method="POST">
          <input type="hidden" name="id" />
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $('#deletionModal').on('show.bs.modal', function(event) {
    const button = $(event.relatedTarget); // Button that triggered the modal
    const id = button.data('id'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    const modal = $(this);
    modal.find('.modal-footer input[name=id]').val(id);
  });
</script>
