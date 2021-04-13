<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark text-white text-center p-2 rounded">
  <i class="bi bi-bag-check text-success" style="font-size: 4em;"></i>
  <h1>Ditt köp har genomförts</h1>
  <p>En orderbekräftelse har skickats till <?= esc($email) ?></p>

  <section class="w-75 mx-auto mb-5">
    <h3 class="text-start text-info">Orderdetaljer</h3>
    <div class="container border border-secondary rounded">

      <?php foreach($orderItems as $item) : ?>

      <?= view_cell('App\Libraries\OrderItems::item', $item) ?>

      <?php endforeach; ?>

      <div class="row mt-3">
        <div class="col text-start">
          <h4 class="m-0">Totalbelopp</h4>
        </div>
        <div class="col text-end">
          <h4 class="m-0"><?= esc($orderPrice) ?> SEK</h4>
        </div>
      </div>
      <hr class="m-0 mt-3">
      <div class="row mt-3">
        <div class="col text-start">
          <h4>Ordernummer</h4>
        </div>
        <div class="col text-end">
          <h4>#<?= esc($orderNumber) ?></h4>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>