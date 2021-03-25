<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="row bg-dark m-0 shadow rounded">
  <div class="col-lg-2 menu-bg p-0 rounded-start">
    <?= $this->include('./templates/sortbar') ?>
  </div>
  <div class="col-12 col-lg-10">
    <div class="<?= session()->has('cartSuccess') ? 'd-block' : 'd-none' ?> alert alert-success mt-1 text-center">
      <?= session()->get('cartSuccess') ?>
    </div>
    <div class="row justify-content-center row-cols-1 row-cols-sm-3 mb-3">
      <?php foreach ($products as $product) : ?>
      <?= view_cell('\App\Libraries\Shop::productItem', $product) ?>
      <?php endforeach; ?>
    </div>
    <?= $pager->links('group', 'front_full') ?>
  </div>
</div>
<?= $this->endSection() ?>