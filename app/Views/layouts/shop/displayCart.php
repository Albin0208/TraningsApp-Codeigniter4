      <!-- Card -->
      <div class="card mb-3 bg-dark text-white">
        <div class="card-body">
          <div class="row mb-3">
            <h5 class="col-10">Varukorg (Antal varor: <?= $cart->totalItems() ?>)</h5>
            <a href="/cart/destroyCart" class="btn btn-outline-danger col">Töm varukorgen</a>
          </div>
          <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 60vh;">
            <?php foreach ($cart->contents() as $item) : ?>
            <?= form_open(base_url('/cart/editCart'), 'class="row mb-4 p-2 m-0"') ?>
            <?= form_hidden('rowid', $item['rowid']) ?>
            <div class="col-md-5 col-lg-3 col-xl-3">
              <div class="rounded mb-3 mb-md-0">
                <img class="img-fluid w-100" src="<?= $item['image'] ?>">
              </div>
            </div>
            <div class="col-md-7 col-lg-9 col-xl-9 d-flex flex-column justify-content-between">
              <div class="d-flex justify-content-between">
                <div class="row">
                  <h5><a class="text-white"
                      href="<?= base_url("/shop/product/{$item['slug']}") ?>"><?= $item['name'] ?></a></h5>
                  <?php if ($cart->hasOptions($item['rowid'])) : ?>
                  <?php foreach ($cart->productOptions as $option_name => $option_value) : ?>
                  <p class="mb-2"><span class="text-uppercase"><?= $option_name ?></span> - <span
                      class="text-uppercase"><?= $option_value ?></span></p>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </div>
                <div>
                  <div class="mb-0 w-100">
                    <ul class="col-6 pagination justify-content-start set_quantity custom-pagination">
                      <li class="page-item page-item-custom border-custom rounded-start">
                        <button class="page-link page-link-custom overlay1 border-custom" name="action"
                          value="decrease">
                          <i class="bi bi-dash text-white"></i>
                        </button>
                      </li>
                      <li class="page-item page-item-custom border-custom"><input type="text" readonly
                          class="page-link page-link-custom h-100 overlay1 border-custom" value="<?= $item['qty'] ?>">
                      </li>
                      <li class="page-item page-item-custom border-custom rounded-end">
                        <button class="page-link page-link-custom overlay1 border-custom" type="submit" name="action"
                          value="increase">
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
            <?= form_close() ?>
            <hr class="mb-4">
            <?php endforeach; ?>
          </div>
          <p class="text-primary mt-1 mb-0"><i class="bi bi-info-circle-fill me-1"></i>
            Vänta inte med att beställa, att lägga till varor i din kundvagn betyder inte att du bokar dem.</p>
        </div>
      </div>
      <!-- Card -->