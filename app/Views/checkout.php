<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<section>
  <!--Grid row-->
  <div class="row m-0">
    <!--Grid column-->
    <div class="col-lg-8 p-0 px-md-1 order-5 order-md-1">
      <!-- Card -->
      <div class="card mb-3 bg-dark text-white">
        <div class="card-body">
          <?= $this->include('/layouts/templates/checkout/shipping') ?>
        </div>
      </div>
      <!-- Card -->
    </div>
    <!--Grid column-->
    <div class="col-lg-4 p-0 px-md-1 order-1 order-md-5">
      <!-- Card -->
      <div class="card mb-3 bg-dark text-white custom-sticky">
        <div class="card-body">
          <h5 class="mb-3">Order översikt</h5>
          <h6 class="card-subtitle mb-2 text-muted">Antal varor: <?= $cart->totalItems() ?> st</h6>
          <hr>
          <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 300px;">
            <?php foreach ($cart->contents() as $item) : ?>
            <div class="d-flex">
              <img class="img-fluid" src="<?= $item['image'] ?>" width="74" height="74">
              <div class="w-100 d-flex flex-column justify-content-between ms-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <h5><?= $item['name'] ?></h5>
                    <?php if ($cart->hasOptions($item['rowid'])) : ?>
                    <?php foreach ($cart->productOptions as $option_name => $option_value) : ?>
                    <p class="mb-2"><span class="text-uppercase"><?= $option_name ?></span> - <span
                        class="text-uppercase"><?= $option_value ?></span></p>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                  <div class="d-flex align-items-center ms-auto">
                    <input type="text" disabled
                      class="form-control form-control-color overlay1 border-custom text-center me-1"
                      value="<?= $item['qty'] ?>">
                    <p class="mb-0 align-middle"><span><strong><?= $item['subtotal'] ?> SEK</strong></span></p>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php endforeach; ?>
          </div>
          <hr>
          <!-- Desktop checkout -->
          <div class="d-none d-md-block">
            <ul class="list-group list-group-flush">
              <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Ordinarie Pris
                <span><?= $cart->total() ?> SEK</span>
              </li>
              <?php if ($cart->discountValue()) : ?>
              <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                <span>Rabatt: (<small><?= esc($cart->discountCode()) ?></small>)</span>
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
                <span><strong><?= $cart->total() - $cart->discountValue() ?> SEK</strong></span>
              </li>
            </ul>
            <button class="w-100 btn btn-primary btn-lg m-0 ad-none d-md-blocka" form="form_id" type="submit">Slutför
              köp</button>
          </div>
          <!-- Desktop checkout -->
          <!-- Mobile checkout -->
          <div class="d-md-none fixed-bottom w-100 card-body bg-darkGrey border-top">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item bg-darkGrey d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Ordinarie Pris
                <span><?= $cart->total() ?> SEK</span>
              </li>
              <?php if ($cart->discountValue()) : ?>
              <li
                class="list-group-item bg-darkGrey d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                <span>Rabatt: (<small><?= esc($cart->discountCode()) ?></small>)</span>
                <span class="text-danger">-<?= $cart->discountValue() ?> SEK</span>
              </li>
              <?php endif; ?>
              <li
                class="list-group-item bg-darkGrey d-flex justify-content-between border-white align-items-center px-0">
                Frakt
                <span>Gratis</span>
              </li>
              <li
                class="list-group-item bg-darkGrey d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Totala beloppet</strong>
                </div>
                <span><strong><?= $cart->total() - $cart->discountValue() ?> SEK</strong></span>
              </li>
            </ul>
            <button class="w-100 btn btn-primary btn-lg m-0 ad-none d-md-blocka" form="form_id" type="submit">Slutför
              köp</button>
          </div>
          <!-- Mobile checkout -->
        </div>
      </div>
      <!-- Card -->
    </div>
    <!-- Card -->
  </div>
  <!--Grid column-->
  </div>
  <!--Grid row-->
</section>

<?= $this->endSection() ?>