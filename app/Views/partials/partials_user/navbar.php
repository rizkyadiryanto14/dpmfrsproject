<nav class="navbar navbar-expand-lg navbar-light bg-transparent ml-4 mr-4">

  <a class="navbar-brand" href="<?= base_url('/') ?>">
    <img src="/assets/img/parlemen.png" width="80" alt="logo">
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse text-center " id="navbarSupportedContent">
    <ul class="navbar-nav mx-md-auto">

      <li class="nav-item active">
        <a class="nav-link text-dark" href="<?= base_url('/') ?>">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= base_url('tentang') ?>">Tentang Kami</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="<?= base_url('login') ?>">Login</a>
      </li>

    </ul>
  </div>
</nav>