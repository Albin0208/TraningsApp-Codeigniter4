<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="row account-page m-0 bg-dark shadow">
  <div class="col-lg-2 menu-bg p-0">
    <?= $this->include('./layouts/templates/sidebar') ?>
  </div>
  <div class="col-lg-10 col-sm-12 pt-2 account-page">
    <div class="d-flex">
      <!-- Taggen ned ska bytas ut till echo och vad som skrivs ut bestäms via controllern -->
      <h1 class="text-white">Min Profil</h1>
      <button class="navbar-toggler navbar-dark ms-auto d-sm-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNava" aria-controls="navbarNava" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-white"></span>
      </button>
    </div>
    <hr class="text-white">
    <?php $this->renderSection("userPage") ?>
  </div>
</div>

<?= $this->endSection() ?>