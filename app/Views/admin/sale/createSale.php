<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark text-white p-3">
  <?= form_open(current_url(), 'data-parsley-validate id="form_id" novalidate') ?>
  <div class="row row-cols-1 row-cols-sm-2 gx-2 mt-3">
    <div class="col">
      <div class="form-floating col-sm">
        <input type="text" class="form-control border-custom overlay1 <?= isInvalid('saleName') ?>" name="saleName"
          value="<?= set_value('saleName') ?>" id="saleName" placeholder="Kampanjnamn"
          data-parsley-pattern="/^[A-Za-zÀ-ÿ0-9 ]+$/" data-parsley-errors-container="#invalidSaleName"
          data-parsley-trigger="keyup change" required>
        <label for="saleName">Kampanjnamn</label>
        <div class="text-danger text-start" id="invalidSaleName">
          <?= getError('saleName') ?>
        </div>
      </div>
    </div>
    <div class="col row gx-2 mt-2 mt-sm-0">
      <div class="form-floating col">
        <input type="number" class="form-control border-custom overlay1 <?= isInvalid('productDiscount') ?>"
          name="productDiscount" value="<?= set_value('productDiscount') ?>" id="productDiscount" placeholder="Rabatt"
          data-parsley-errors-container="#invalidProductDiscount" data-parsley-trigger="keyup change" required>
        <label for="productDiscount">Rabatt</label>
        <div class="text-danger text-start" id="invalidProductDiscount">
          <?= getError('productDiscount') ?>
        </div>
      </div>
      <div class="col">
        <div class="overlay2 p-2 shadow">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="discountType" id="exampleRadios1" value="SEK" checked>
            <label class="form-check-label" for="exampleRadios1">
              Rabatt i SEK
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="discountType" id="exampleRadios2" value="Percent">
            <label class="form-check-label" for="exampleRadios2">
              Rabatt i procent
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-sm-2 mt-2">
    <div class="col p-2">
      <div class="overlay2 p-3 shadow h-100">
        <h3 class="mb-1">Kategorier</h3>
        <hr class="mt-0">
        <div class="row">
          <div class="col">
            <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 50vh;">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="0" disabled id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Allt
                </label>
              </div>
              <?php foreach($categories as $category) : ?>
              <div class="form-check">
                <input class="form-check-input" name="categories[]" disabled type="checkbox"
                  value="<?= $category['category_id'] ?>" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  <?= $category['category_name'] ?>
                </label>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col p-2">
      <div class="overlay2 p-3 shadow">
        <h3 class="mb-1">Produkter</h3>
        <hr class="mt-0">
        <div class="row">
          <div class="col">
            <div class="overflow-auto bg-dark overlay1 p-2 border rounded border-secondary" style="max-height: 50vh;">
              <?php foreach($products as $product) : ?>
              <div class="form-check">
                <input class="form-check-input" name="products[]" type="checkbox" value="<?= $product['product_id'] ?>"
                  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  <?= $product['name'] ?> | <?= $product['price'] ?> SEK | <?= $product['category_name'] ?>
                </label>
              </div>
              <hr class="m-1">
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input type="submit" value="Skapa" class="btn btn-lg btn-outline-info mt-4">
  <?= form_close() ?>
</div>

<?= $this->endSection() ?>