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
        <form class="row align-items-center" action="<?= base_url('meeting') ?>" method="GET">
          <div class="col-sm-12 col-md">
            <h3 class="d-inline-block mb-0">Daftar Rapat</h3>
          </div>  
          <!-- Filter -->
          <div class="col-sm-4 col-md-3 col-lg-2">
            <select name="filter" id="filter" class="form-control">
              <option value="all" selected>Semua</option>
              <option value="accepted">Diterima</option>
              <option value="declined">Ditolak</option>
              <option value="pending">Belum diterima</option>
            </select>
          </div>
          <!-- Search -->
          <div class="col-sm-8 col-md-5 col-lg-4">
            <div class="input-group">
              <input class="form-control" placeholder="Cari Rapat" type="text" name="search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Cari</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col" class="sort" data-sort="meeting_title">Nama acara</th>
              <th scope="col" class="sort" data-sort="meeting_leader">Pemimpin acara</th>
              <th scope="col" class="sort" data-sort="meeting_participant">Jumlah peserta</th>
              <th scope="col" class="sort" data-sort="opd_name">OPD</th>
              <th scope="col" class="sort" data-sort="room_name">Ruangan</th>
              <th scope="col" class="sort" data-sort="start_time">Mulai pada</th>
              <th scope="col" class="sort" data-sort="finish_time">Selesai pada</th>
              <?php if (is_admin()) : ?>
                <th scope="col" class="sort" data-sort="booked_by">Nama pemesan rapat</th>
              <?php endif; ?>
              <th scope="col" class="sort" data-sort="status">Status</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="list">
            <?php
            foreach ($meetings as $meeting) :
            ?>
              <tr>
                <td>
                  <?= $meeting->meeting_title ?>
                </td>
                <td>
                  <?= $meeting->meeting_leader ?>
                </td>
                <td>
                  <?= $meeting->meeting_participant ?>
                </td>
                <td>
                  <?= $meeting->opd_name ?>
                </td>
                <td>
                  <?= $meeting->room_name ?>
                </td>
                <td>
                  <?= $meeting->start_time ?>
                </td>
                <td>
                  <?= $meeting->finish_time ?>
                </td>
                <?php if (is_admin()) : ?>
                  <td>
                    <?= empty($meeting->user_fullname) ? $meeting->guest_fullname : $meeting->user_fullname ?>
                  </td>
                <?php endif; ?>
                <td>
                  <span class="badge badge-pill 
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
                </td>
                <td class="text-right">
                  <?php if (is_admin() || $meeting->accepted != null) : ?>
                    <a href="<?= base_url("meeting/show/$meeting->id") ?>" class="btn btn-outline-primary">Detail</a>
                  <?php else : ?>
                    <a href="<?= base_url("meeting/edit/$meeting->id") ?>" class="btn btn-outline-primary">Edit</a>
                    <button type="button" class="btn btn-outline-danger" data-id="<?= $meeting->id ?>" data-toggle="modal" data-target="#deletionModal">
                      Hapus
                    </button>
                  <?php endif; ?>
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
        <h5 class="modal-title" id="deletionModalLabel">Hapus Rapat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus rapat ini? Rapat akan dihapus secara permanen dan tidak dapat kembali
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="<?= base_url('meeting/delete') ?>" method="POST">
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