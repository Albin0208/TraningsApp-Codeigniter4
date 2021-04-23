<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="container w-100 p-4 bg-dark shadow">
  <?php if (session()->has('cartSuccess')) : ?>
  <div class="alert alert-success mt-1 text-centera row">
    <p class="col m-0"><?= session()->get('cartSuccess') ?></p>
    <a class="ms-auto col text-end" href="/cart">
      Till varukorgen
    </a>
  </div>
  <?php endif; ?>
  <a href="/shop" class="btn mb-2"><i class="bi bi-arrow-left text-white fs-2"></i></a>
  <div class="row row-cols-1 row-cols-xl-2">
    <div class="col text-center">
      <img src="<?= $product['image'] ?>" class="img-fluid">
    </div>
    <div class="col text-white my-3">
      <div class="row mb-3">
        <h2 class="text-uppercase fw-bold"><?= $product['name'] ?></h2>
      </div>
      <p><?= $product['description'] ?></p>
      <h4 class="col"><?= $product['price'] ?> SEK</h4>
      <?= form_open(base_url('/shop/addToCart'), 'class="row mx-auto"') ?>
      <?= form_hidden('product_id', $product['product_id']) ?>
      <input type="number" name="quantity" class="col form-control me-2 overlay1" value="1">
      <button type="submit" class="btn btn-primary btn-lg col-9">Lägg i varukorg</button>
      <?= form_close() ?>
    </div>
  </div>
</div>

<?= $this->endSection() ?>