<?= $this->extend('layouts/master_voting') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('partials/partials_user/navbar') ?>

<section id="home">
  <div class="container">
    <div class="content mt-5 mb-5">
      <div class="row">
        <div class="col-md-12">
          <div class="steps">
            <div class="row align-item-center">
              <div class="col-12 col-sm-6 order-sm-2">
                <div class="steps_image">
                  <img src="/assets/img/fakultas.png" class="img-fluid" width="500">
                </div>
              </div>
              <div class="col-12 col-sm-6 order-sm-1">
                <p class="mt-3 text-dark">Ayo pilih pemimpinmu untuk masa depan Fakultas Rekayasa Sistem maju</p>

                <div class="row">
                  <div class="col-md-6">
                    <a href="<?= base_url('voting') ?>" class="btn btn-warning">Mulai Voting</a>

                    <a href="<?= base_url('tentang') ?>" class="btn btn-info">Tentang Kami</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>