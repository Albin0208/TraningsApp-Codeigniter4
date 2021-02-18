<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<!--Section: Block Content-->
<section>
  <!--Grid row-->
  <div class="row">
    <!--Grid column-->
    <div class="col-lg-8">
      <!-- Card -->
      <div class="card mb-3 bg-dark text-white">
        <div class="card-body">
          <h5 class="mb-4">Varukorg (Antal varor: <?= $cart->totalItems() ?>)</h5>
          <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 60vh;">
            <?php foreach ($cart->contents() as $item) : ?>
              <form action="/cart/editCart" class="row mb-4 p-2 me-0" method="post">
                <?= form_hidden('rowid', $item['rowid']) ?>
                <div class="col-md-5 col-lg-3 col-xl-3">
                  <div class=" rounded mb-3 mb-md-0">
                    <img class="img-fluid w-100" src="<?= $item['image'] ?>">
                  </div>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9 d-flex flex-column justify-content-between">
                  <div class="d-flex justify-content-between">
                    <div class="row">
                      <h5><?= $item['name'] ?></h5>
                      <?php if ($cart->hasOptions($item['rowid'])) : ?>
                        <?php foreach ($cart->productOptions as $option_name => $option_value) : ?>
                          <p class="mb-2"><span class="text-uppercase"><?= $option_name ?></span> - <span class="text-uppercase"><?= $option_value ?></span></p>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                    <div>
                      <div class="mb-0 w-100">
                        <ul class="col-6 pagination justify-content-start set_quantity custom-pagination">
                          <li class="page-item page-item-custom border-custom rounded-start">
                            <button class="page-link page-link-custom overlay1 border-custom" name="action" value="decrease">
                              <i class="bi bi-dash text-white"></i>
                            </button>
                          </li>
                          <li class="page-item page-item-custom border-custom"><input type="text" readonly class="page-link page-link-custom h-100 overlay1 border-custom" value="<?= $item['qty'] ?>">
                          </li>
                          <li class="page-item page-item-custom border-custom rounded-end">
                            <button class="page-link page-link-custom overlay1 border-custom" type="submit" name="action" value="increase">
                              <i class="bi bi-plus text-white"></i>
                            </button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div>
                      <button type="submit" name="action" value="delete" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Ta bort
                      </button>
                    </div>
                    <p class="mb-0"><span><strong><?= $item['subtotal'] ?> SEK</strong></span></p>
                  </div>
                </div>
              </form>
              <hr class="mb-4">
            <?php endforeach; ?>
          </div>
          <p class="text-primary mt-1 mb-0"><i class="bi bi-info-circle-fill me-1"></i>
            Vänta inte med att beställa, att lägga till varor i din kundvagn betyder inte att du bokar dem.</p>
        </div>
      </div>
      <!-- Card -->
    </div>
    <!--Grid column-->
    <div class="col-lg-4">
      <!-- Card -->
      <div class="card mb-3 bg-dark text-white">
        <div class="card-body">
          <h5 class="mb-3">Order sammanfattning</h5>
          <hr>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
              Ordinarie Pris
              <span><?= $cart->total() ?> SEK</span>
            </li>
            <?php if ($cart->discountValue()) : ?>
              <li class="list-group-item bg-dark d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                <span>Rabatt: (<small><?= $cart->discountCode() ?></small>) <a href="/coupon/delete">Ta bort</a></span>
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
          <a href="cart/checkout" class="btn btn-outline-info">Till kassan</a>
        </div>
      </div>
      <!-- Card -->
      <div class="card mb-3 discount_code bg-dark text-white">
        <div class="card-body">
          <p class="d-flex justify-content-between">
            Lägg till en rabattkod (Valfritt)
          </p>
          <form action="/coupon" method="post">
            <div class="mt-3">
              <input type="text" name="discount_code" class="form-control overlay1 border-custom <?= session()->has('couponFail') ? 'is-invalid' : '' ?>" placeholder="Rabattkod">
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
            <button type="submit" name="action" value="discount" class="btn btn-outline-success btn-sm mt-3">Använd Rabattkoden</button>
          </form>
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