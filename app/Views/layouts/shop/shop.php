<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="row bg-dark m-0 shadow rounded">
  <div class="col-lg-2 menu-bg p-0 rounded-start">
    <?= $this->include('./templates/sortbar') ?>
  </div>
  <div class="col-12 col-lg-10">
    <?php if (session()->has('cartSuccess')) : ?>
    <div class="alert alert-success mt-1 text-centera row">
      <p class="col m-0"><?= session()->get('cartSuccess') ?></p>
      <a class="ms-auto col text-end" href="/cart">
        Till varukorgen
      </a>
    </div>
    <?php endif; ?>
    <div class="row justify-content-center row-cols-1 row-cols-sm-3 mb-3">
      <?php foreach ($products as $product) : ?>
      <?= view_cell('\App\Libraries\Shop::productItem', $product) ?>
      <?php endforeach; ?>
    </div>
    <?= $pager->links('group', 'front_full') ?>
  </div>
</div>
<?= $this->endSection() ?>