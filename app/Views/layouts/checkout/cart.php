<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<!--Section: Block Content-->
<section>
  <!--Grid row-->
  <div class="row m-0 gx-2">
    <!--Grid column-->
    <div class="col-lg-8 p-0 px-md-1">
      <?= $cart->totalItems() == 0 ? '<h2 class="text-white">Varukorgen är tom <a href="/shop">Gå till butiken</a></h2>' : $this->include('/layouts/shop/displayCart') ?>
    </div>
    <!--Grid column-->
    <div class="col-lg-4 p-0 px-md-1">
      <!-- Card -->
      <div class="card mb-3 bg-dark text-white">
        <div class="card-body">
          <h5 class="mb-3">Order sammanfattning</h5>
          <hr>
          <ul class="list-group list-group-flush">
            <li
              class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0 text-white">
              Ordinarie Pris
              <span><?= $cart->total() ?> SEK</span>
            </li>
            <?php if ($cart->discountValue()) : ?>
            <li
              class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0 text-white">
              <span>
                Rabatt: (<small><?= esc($cart->discountCode()) ?> - <a href="/cart/removeDiscount">Ta bort</a></small>)
              </span>
              <span class="text-danger">-<?= $cart->discountValue() ?> SEK</span>
            </li>
            <?php endif; ?>
            <li
              class="list-group-item bg-dark d-flex justify-content-between border-white align-items-center px-0 text-white">
              Frakt
              <span>
                <?php if ($cart->shipping() == 0) : ?>
                Gratis
                <?php else : ?>
                49 SEK
                <?php endif; ?>
              </span>
            </li>
            <li
              class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 mb-3 text-white">
              <div>
                <strong>Totala beloppet</strong>
              </div>
              <span><strong><?= $cart->total() - $cart->discountValue() + $cart->shipping() ?> SEK</strong></span>
            </li>
          </ul>
          <button onclick="location.href='cart/checkout'" class="btn btn-outline-info"
            <?= $cart->totalItems() == 0 ? 'disabled' : '' ?>>Till
            kassan</button>
        </div>
      </div>
      <!-- Card -->
      <div class="card mb-3 discount_code bg-dark text-white">
        <div class="card-body">
          <p class="d-flex justify-content-between">
            Lägg till en rabattkod (Valfritt)
          </p>
          <?= form_open(base_url('/coupon')) ?>
          <div class="mt-3">
            <input type="text" name="discount_code"
              class="form-control overlay1 border-custom <?= session()->has('couponFail') ? 'is-invalid' : '' ?>"
              placeholder="Rabattkod">
            <?php if (session()->has('couponSuccess')) : ?>
            <div class="alert alert-success mt-2">
              <?= session()->get('couponSuccess') ?>
            </div>
            <?php elseif (session()->has('couponFail')) : ?>
            <div class="alert alert-danger mt-2">
              <?= session()->get('couponFail') ?>
            </div>
            <?php endif; ?>
          </div>
          <button type="submit" name="action" value="discount" class="btn btn-outline-success btn-sm mt-3">Använd
            Rabattkoden</button>
          <?= form_close() ?>
        </div>
      </div>
    </div>
    <!-- Card -->
  </div>
  <!--Grid column-->
  </div>
  <!--Grid row-->
</section>
<!--Section: Block Content-->
<?= $this->endSection() ?>