<div class="col my-1 px-1">
  <div class="card p-2 text-white h-100 shadow" style="background-color: #1d1d1d;">
    <a href="/shop/product/<?= esc($product['slug']) ?>" class="text-decoration-none text-white m-0 p-0">
      <!-- TODO Fixa så att nedanstående visas bara när produkten är en nyhet -->
      <div class="bg-danger position-absolute p-2 rounded shadow">
        <h5 class="m-0">Nyhet</h5>
      </div>
      <img src="<?= esc($product['image']) ?>" class="card-img-top" alt="..." width="400" height="400">
      <div class="card-body">
        <h5 class="card-title p-0 mx-auto"><?= esc($product['name']) ?></h5>
      </div>
    </a>
    <div class="card-footer border-0 mt-auto" style="background-color: #1d1d1d;">
      <h6 class="card-text mb-1"><strong><?= esc($product['price']) ?> kr</strong></h6>
      <?= form_open('shop/addToCart') ?>
      <?= form_hidden('product_id', $product['product_id']) ?>
      <button type="submit" class="btn w-100 btn-primary">Lägg i varukorgen</button>
      <?= form_close() ?>
    </div>
  </div>
</div>