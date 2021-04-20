<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark text-white p-3">
  <?= form_open(current_url(), 'data-parsley-validate id="form_id" novalidate') ?>
  <?= form_hidden('id', $product['product_id']) ?>
  <div class="row gx-2 mt-3">
    <div class="form-floating col-sm">
      <input type="text" class="form-control border-custom overlay1 <?= isInvalid('productName') ?>" name="productName"
        value="<?= $product['name'] ?? set_value('productName') ?>" id="productName" placeholder="Produktnamn"
        data-parsley-pattern="/^[A-Za-zÀ-ÿ ]+$/" data-parsley-errors-container="#invalidProductName"
        data-parsley-trigger="keyup change" required>
      <label for="productName">Produktnamn</label>
      <div class="text-danger text-start" id="invalidProductName">
        <?= getError('productName') ?>
      </div>
    </div>
  </div>
  <div class="row gx-2 mt-3">
    <div class="col">
      <div class="row gx-2">
        <div class="form-floating col-sm">
          <input type="number" class="form-control border-custom overlay1 <?= isInvalid('productPrice') ?>"
            name="productPrice" value="<?= $product['price'] ?? set_value('productPrice') ?>" id="productPrice"
            placeholder="Produktnamn" data-parsley-errors-container="#invalidProductPrice"
            data-parsley-trigger="keyup change" required>
          <label for="productPrice">Pris</label>
          <div class="text-danger text-start" id="invalidProductPrice">
            <?= getError('productPrice') ?>
          </div>
        </div>
        <div class="form-floating col-sm">
          <input type="number" class="form-control border-custom overlay1 <?= isInvalid('productDiscount') ?>"
            name="productDiscount" value="<?= set_value('productDiscount') ?>" id="productDiscount" placeholder="Rabatt"
            data-parsley-errors-container="#invalidProductDiscount" data-parsley-trigger="keyup change" required>
          <label for="productDiscount">Rabatt</label>
          <div class="text-danger text-start" id="invalidProductDiscount">
            <?= getError('productDiscount') ?>
          </div>
        </div>
        <div class="col">
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
      <div class="row gx-2 mt-3">
        <div class="col-sm">
          <select name="type" class="form-select bg-dark text-white">
            <option value="" selected>Kategori</option>
            <?php foreach($categories	as $category) : ?>
            <option value="<?= $category['category_id'] ?>"
              <?= $product['type'] == $category['category_id'] ? 'selected' : '' ?>><?= $category['category_name'] ?>
            </option>
            <?php endforeach; ?>
          </select>
          <div class="text-danger text-start" id="type">
            <?= getError('type') ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <label for="productDescription" class="fs-5">Produktbeskrivning</label>
      <textarea class="w-100 bg-darkGrey text-white" name="productDescription"
        rows="3"><?= $product['description'] ?></textarea>
    </div>
  </div>
  <input type="submit" value="Uppdatera" class="btn btn-lg btn-outline-info mt-4">
  <?= form_close() ?>
</div>

<?= $this->endSection() ?>