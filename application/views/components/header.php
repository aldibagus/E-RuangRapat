<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <?php if (isset($title)) : ?>
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">
              <?= $title ?>
            </h6>
          </div>
        <?php endif; ?>
        <?php if (isset($create_url)) : ?>
        <div class="col-lg-6 col-5 text-right">
          <a href="<?= $create_url ?>" class="btn btn-secondary">Tambah</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>