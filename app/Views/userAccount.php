<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="row account-page-content mt-2 account-page">
  <?= $this->include('./layouts/templates/sidebar') ?>
  <div class="col-10 pt-2">
    <!-- Taggen ned ska bytas ut till echo och vad som skrivs ut bestäms via controllern -->
    <h1 class="text-white">Min Profil</h1>
    <hr class="text-white">
    <?php $this->renderSection("userPage") ?>
  </div>
</div>

<?= $this->endSection() ?>