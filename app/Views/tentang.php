<?= $this->extend('layouts/master_voting') ?>

<?= $this->section('title') ?>
<?= $title; ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('partials/partials_user/navbar') ?>

<section id="tentang">
  <div class="container">
    <div class="content mt-5 mb-5">
      <div class="profile text-center">
        <img src="/assets/img/parlemen.png" class="img-fluid rounded-circle" width="300" alt="profile-img">

        <h3 class="mt-4">DPM Fakultas Rekayasa Sistem</h3>
        <p>Dewan Perwakilan Mahasiswa adalah institusi kampus di atas BEM yang mengawasi BEM secara penuh.
        </p>
        <h5>
          Voting Online
        </h5>

        <div class="social-link">
          <a href="https://github.com/robbiabd" target="_blank"><i class="fab fa-instagram fa-3x text-dark"></i></a>
          <a href="https://api.whatsapp.com/send?phone=6285156185946" target="_blank"><i class="fab fa-whatsapp fa-3x text-dark"></i></i></a>
        </div>

      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>