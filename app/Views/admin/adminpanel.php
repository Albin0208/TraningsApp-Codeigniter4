<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark p-3 text-white">
  <?php if (session()->has('success')) : ?>
  <div class="alert alert-success col-sm-10 ms-auto me-auto w-100">
    <?= session()->get('success') ?>
  </div>
  <?php elseif (session()->has('error')) :?>
  <div class="alert alert-danger col-sm-10 ms-auto me-auto w-100">
    <?= session()->get('error') ?>
  </div>
  <?php endif; ?>
  <h1 style="font-size: 4em;">Admin panelen</h1>
  <hr>
  <!-- General information -->
  <div class="row row-cols-1 row-cols-sm-4 gx-3">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $customerCount ?></h1>
          <h5 class="card-subtitle">Antal kunder</h5>
        </div>
      </div>
    </div>
    <div class="col mt-2 mt-sm-0">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $orderCount ?></h1>
          <h5 class="card-subtitle">Antal beställningar</h5>
        </div>
      </div>
    </div>
    <div class="col mt-2 mt-sm-0">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $totalRevenue ?> SEK</h1>
          <h5 class="card-subtitle">Totala intäkter</h5>
        </div>
      </div>
    </div>
    <div class="col mt-2 mt-sm-0">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $productCount ?></h1>
          <h5 class="card-subtitle">Antal produkter</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- /General information -->

  <!-- Beställningar och kunder -->
  <div class="row row-cols-1 row-cols-sm-2 gx-3 mt-4">
    <div class="col-12 col-sm-7">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h2 class="card-title">Senaste beställningarna</h2>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Order</th>
                <th scope="col">Datum</th>
                <th scope="col">Summa</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($latestOrders as $order) : ?>
              <tr>
                <th scope="row" class="align-middle"><a class="text-decoration-none text-info"
                    href="<?= base_url("/admin/order/{$order['order_number']}") ?>">#<?= esc($order['order_number']) ?></a>
                </th>
                <td class="align-middle"><?= esc($time->parse($order['created_at'])->toDateString()) ?></td>
                <td class="align-middle">
                  <?= esc($order['order_price'] + $order['shipping'] - $order['discount_value']) ?> SEK för
                  <?= esc($order['quantity']) ?>
                  <?= $order['quantity'] <= 1 ? 'artikel' : 'artiklar' ?></td>
                <td class="text-end"><a class="btn btn-outline-info"
                    href="<?= base_url("/admin/order/{$order['order_number']}") ?>">Visa</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5 mt-2 mt-sm-0">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h2 class="card-title">Nyaste kunderna</h2>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Användarnamn</th>
                <th scope="col">Gick med</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($latestCustomers as $customer) : ?>
              <tr>
                <th scope="row" class="align-middle">
                  <?= esc($customer['firstname']) ?> <?= esc($customer['lastname']) ?>
                </th>
                <td class="align-middle"><?= $customer['username'] ?></td>
                <td class="align-middle"><?= esc($time->parse($customer['created_at'])->toDateString()) ?></td>
                <td class="text-end"><a class="btn btn-outline-info"
                    href="<?= base_url("/admin/customer/{$customer['username']}") ?>">Visa</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /Beställningar och kunder -->

  <!-- Produkter -->
  <div class="row gx-3 mt-4">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col-8">Produkter</h2>
            <div class="col-4 text-end">
              <a href="/admin/createProduct" class="btn btn-outline-info">Lägg till produkt</a>
            </div>
          </div>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Pris</th>
                <th scope="col">Kategori</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product) : ?>
              <tr>
                <th scope="row" class="align-middle"><a class="text-info" href="/shop/product/<?= $product['slug'] ?>">
                    <?= esc($product['name']) ?></a>
                </th>
                <td class="align-middle"><?= $product['price'] ?> SEK</td>
                <td class="align-middle"><?= $product['category_name'] ?></td>
                <td class="text-end">
                  <button onclick="modal('product', '<?= $product['slug'] ?>')"
                    class="btn btn-outline-danger">Radera</button>
                  <a class="btn btn-outline-info" href="/admin/editProduct/<?= $product['slug'] ?>">Redigera</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('products', 'front_full') ?>
      </div>
    </div>
  </div>
  <!-- /Produkter -->

  <!-- Kampanjer -->
  <div class="row mt-4">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col">Kampanjer</h2>
            <div class="col text-end">
              <a href="/admin/createSale" class="btn btn-outline-info">Skapa kampanj</a>
            </div>
          </div>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Kampanj värde</th>
                <th scope="col">Antal produkter</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($sales as $sale) : ?>
              <tr>
                <th scope="row" class="align-middle">
                  <?= esc($sale['sale_name']) ?>
                </th>
                <td class="align-middle">
                  <span class="text-danger">-<?= $sale['sale_value'] ?></span>
                  <span><?= $sale['value_type'] == 'Percent' ? 'Procent' : $sale['value_type']?></span>
                </td>
                <td class="align-middle"></td>
                <td class="text-end">
                  <button onclick="modal('sale', '<?= $sale['sale_name'] ?>')"
                    class="btn btn-outline-danger">Avsluta</button>
                  <a class="btn btn-outline-info" href="/admin/editSale/<?= $sale['sale_name'] ?>">Redigera</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('sales', 'front_full') ?>
      </div>
    </div>
  </div>
  <!-- /Kampanjer -->

  <!-- Rabatter och kategorier -->
  <div class="row row-cols-1 row-cols-sm-2 gx-3 mt-4">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col">Rabattkoder</h2>
            <div class="col text-end">
              <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#discountModal">Skapa
                rabattkod</button>
            </div>
          </div>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Namn</th>
                <th scope="col">Värde</th>
                <th scope="col" class="text-end">Åtgärder</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($coupons as $coupon) : ?>
              <tr>
                <th scope="row" class="align-middle">
                  <?= esc($coupon['name']) ?>
                </th>
                <td class="align-middle">
                  <span class="text-danger">-<?= $coupon['value'] ?></span>
                  <span><?= $coupon['type'] == 'Percent' ? 'Procent' : $coupon['type']?></span>
                </td>
                <td class="text-end">
                  <button onclick="modal('coupon', '<?= $coupon['name'] ?>')" class="btn btn-outline-danger">
                    Ta bort</button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('coupons', 'front_full') ?>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col">Nyhetsbrev</h2>
            <div class="col text-end">
              <button data-bs-toggle="modal" data-bs-target="#newsLetterModal" class="btn btn-outline-info">
                Skicka nyhetsbrev</button>
            </div>
          </div>
          <table class="table text-white table-responsive border">
            <thead>
              <tr>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($newsletter as $subscriber) : ?>
              <tr>
                <th scope="row" class="align-middle">
                  <?= esc($subscriber['email']) ?>
                </th>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('newsletter', 'front_full') ?>
      </div>
    </div>
  </div>
  <!-- /Rabatter och kategorier -->
</div>

<!-- Create Discount Modal -->
<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Skapa rabattkod</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open(base_url('admin/createDiscount'), 'data-parsley-validate id="form_id" novalidate') ?>
      <div class="modal-body">
        <div class="row row-cols-1 row-cols-sm-2 gx-2 mt-3">
          <div class="col">
            <div class="form-floating col-sm">
              <input type="text" class="form-control border-custom overlay1" name="discountName" id="discountName"
                placeholder="Namn" data-parsley-pattern="/^[A-Za-zÀ-ÿ0-9 ]+$/"
                data-parsley-errors-container="#invaliddiscountName" data-parsley-trigger="keyup change" required>
              <label for="discountName">Namn</label>
              <div class="text-danger text-start" id="invaliddiscountName">
              </div>
            </div>
            <div class="form-floating col mt-2">
              <input type="number" class="form-control border-custom overlay1" name="productDiscount"
                id="productDiscount" placeholder="Rabatt" data-parsley-errors-container="#invalidProductDiscount"
                data-parsley-trigger="keyup change" required>
              <label for="productDiscount">Värde</label>
              <div class="text-danger text-start" id="invalidProductDiscount">
              </div>
            </div>
          </div>
          <div class="col row gx-2 mt-2 mt-sm-0">
            <div class="col">
              <div class="overlay2 p-2 shadow">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="discountType" id="exampleRadios1" value="SEK"
                    checked>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Avbryt</button>
        <button type="submit" class="btn btn-success">Skapa</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Create Discount Modal -->

<!-- Send Newsletter Modal -->
<div class="modal fade" id="newsLetterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Skicka nyhetsbrev</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?= form_open(base_url('admin/newsletter'), 'data-parsley-validate id="form_id" novalidate') ?>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <div class="form-floating col-sm">
              <input type="text" class="form-control border-custom overlay1" name="subject" id="subject"
                placeholder="Ämne" data-parsley-pattern="/^[A-Za-zÀ-ÿ0-9 ]+$/"
                data-parsley-errors-container="#invalidSubject" data-parsley-trigger="keyup change" required>
              <label for="subject">Ämne</label>
              <div class="text-danger text-start" id="invalidSubject">
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <label for="subject">Innehåll</label>
            <textarea name="content" rows="6" class="w-100 bg-dark overlay1 text-white"></textarea>
            <div class="text-danger text-start" id="invalidSubject">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Avbryt</button>
        <button type="submit" class="btn btn-success">Skicka</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Send Newsletter Modal -->

<script src="/assets/js/modals.js"></script>

<?= $this->endSection() ?>