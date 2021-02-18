<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="row mt-4 row-cols-1 row-cols-lg-2 g-3 m-0">
  <div class="col-12 col-lg-8 card bg-dark text-white shadow m-0">
    <?= $this->include('/layouts/templates/checkout/shipping') ?>
  </div>
  <div class="col-lg-4 text-white d-none d-lg-block card bg-dark shadow m-0">
    <div class="card-body">
      <h2 class="card-title">Order översikt</h2>
      <h6 class="card-subtitle mb-2 text-muted">Antal varor: <?= $cart->totalItems() ?> st</h6>
      <hr>
      <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 300px;">
        <?php foreach ($cart->contents() as $item) : ?>
          <form action="/cart/editCart" class="d-flex" method="post">
            <?= form_hidden('rowid', $item['rowid']) ?>
            <img class="img-fluid" src="<?= $item['image'] ?>" width="74" height="74">
            <div class="w-100 d-flex flex-column justify-content-between ms-3">
              <div class="d-flex justify-content-between">
                <div>
                  <h5><?= $item['name'] ?></h5>
                  <?php if ($cart->hasOptions($item['rowid'])) : ?>
                    <?php foreach ($cart->productOptions as $option_name => $option_value) : ?>
                      <p class="mb-2"><span class="text-uppercase"><?= $option_name ?></span> - <span class="text-uppercase"><?= $option_value ?></span></p>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-auto">
                <div class="d-flex align-items-center ms-auto">
                  <input type="text" disabled class="form-control form-control-color overlay1 border-custom text-center me-1" value="<?= $item['qty'] ?>">
                  <p class="mb-0 align-middle"><span><strong><?= $item['subtotal'] ?> SEK</strong></span></p>
                </div>
              </div>
            </div>
          </form>
          <hr>
        <?php endforeach; ?>
      </div>
      <hr>
      <ul class="list-group list-group-flush">
        <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
          Ordinarie Pris
          <span><?= $cart->total() ?> SEK</span>
        </li>
        <?php if ($cart->discountvalue()) : ?>
          <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
            <span>Rabatt: (<small><?= $cart->discountCode() ?></small>)</span>
            <span class="text-danger">-<?= $cart->discountValue() ?> SEK</span>
          </li>
        <?php endif; ?>
        <li class="list-group-item bg-dark d-flex justify-content-between border-white align-items-center px-0">
          Frakt
          <span>Gratis</span>
        </li>
        <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 mb-3">
          <div>
            <strong>Totala beloppet</strong>
          </div>
          <span><strong><?= $cart->total() - $cart->discountvalue() ?> SEK</strong></span>
        </li>
      </ul>
    </div>
  </div>
</div>

<?= $this->endSection() ?>