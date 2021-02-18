<div class="col my-1 px-1">
  <div class="card p-2 text-white h-100 shadow" style="background-color: #1d1d1d;">
    <a href="/shop/product/<?= esc($product['slug']) ?>" class="text-decoration-none text-white m-0 p-0">
      <img src="<?= esc($product['image']) ?>" class="card-img-top" alt="..." width="400" height="400">
      <div class="card-body">
        <h5 class="card-title p-0 mx-auto"><?= esc($product['name']) ?></h5>
      </div>
      <div class="card-footer border-0 mt-auto" style="background-color: #1d1d1d;">
        <h6 class="card-text mb-1"><strong><?= esc($product['price']) ?> kr</strong></h6>
        <form action="shop/addToCart" method="post">
          <?= form_hidden('product_id', $product['product_id']) ?>
          <?= form_hidden('quantity', 1) ?>
          <a><button type="submit" class="btn w-100 btn-primary">Lägg i varukorgen</button></a>
        </form>
      </div>
    </a>
  </div>
</div>