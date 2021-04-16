<?= $this->extend("layouts/userLayouts/userAccount") ?>
<?= $this->section('userPage') ?>

<?php if (session()->has('success')) : ?>
<div class="alert alert-success">
  <?= session()->get('success') ?>
</div>

<?php endif; ?>

<h6>Följande adresser kommer att användas i kassan</h6>

<section class="row mt-4">
  <div class="col">
    <div class="row">
      <h4 class="fw-bold col-8">Faktureringsadress</h4>
      <a href="<?= current_url() ?>/edit/billing" class="col-3 btn btn-outline-info">
        Redigera <i class="bi bi-pencil-square"></i></a>
    </div>
    <address>
      <?php if (isset($billing)) : ?>
      <?= esc($billing['firstname']) ?> <?= esc($billing['lastname']) ?> <br>
      <?= esc($billing['address']) ?> <br>
      <?= esc($billing['zip_code']) ?> <?= esc($billing['city']) ?> <br>
      <?php else : ?>
      Ingen adress är skapad ännu
      <?php endif; ?>
    </address>
  </div>
  <div class="col">
    <div class="row">
      <h4 class="fw-bold col-8">Leveransadress</h4>
      <a href="<?= current_url() ?>/edit/delivery" class="col-3 btn btn-outline-info">
        Redigera <i class="bi bi-pencil-square"></i></a>
    </div>
    <address>
      <?php if (isset($delivery)) : ?>
      <?= esc($delivery['firstname']) ?> <?= esc($delivery['lastname']) ?> <br>
      <?= esc($delivery['address']) ?> <br>
      <?= esc($delivery['zip_code']) ?> <?= esc($delivery['city']) ?> <br>
      <?php else : ?>
      Ingen adress är skapad ännu
      <?php endif; ?>
    </address>
  </div>
</section>

<?= $this->endSection() ?>