<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>
<div class="container w-100 p-4 bg-dark shadow">
  <a href="/shop" class="btn btn-outline-lighta rounded-circle overlay1a mb-2"><i class="bi bi-arrow-left text-white fs-2"></i></a>
  <div class="row row-cols-1 row-cols-xl-2">
    <div class="col text-center">
      <img src="<?= $product['image'] ?>" class="img-fluid">
    </div>
    <div class="col text-white my-3">
      <div class="row mb-3">
        <h2 class="text-uppercase fw-bold"><?= $product['name'] ?></h2>
      </div>
      <p class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Amet non facere deserunt accusamus eius fugit incidunt itaque eligendi optio adipisci?</p>
      <h4 class="col"><?= $product['price'] ?> SEK</h4>
      <form action="/shop/addToCart" class="row mx-0" method="post">
        <?= form_hidden('product_id', $product['product_id']) ?>
        <input type="number" name="quantity" class="col form-control me-2 overlay1" value="1">
        <button type="submit" class="btn btn-primary btn-lg col-9">Lägg i varukorgen</button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>