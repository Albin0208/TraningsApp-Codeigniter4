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
  <div class="row row-cols-1 row-cols-sm-4 gx-3">
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $customerCount ?></h1>
          <h5 class="card-subtitle">Antal kunder</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $orderCount ?></h1>
          <h5 class="card-subtitle">Antal beställningar</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $totalRevenue ?> SEK</h1>
          <h5 class="card-subtitle">Totala intäkter</h5>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <h1 class="card-title"><?= $productCount ?></h1>
          <h5 class="card-subtitle">Antal produkter</h5>
        </div>
      </div>
    </div>
  </div>
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
                    href="view-order/<?= esc($order['order_number']) ?>">#<?= esc($order['order_number']) ?></a></th>
                <td class="align-middle"><?= esc($time->parse($order['created_at'])->toDateString()) ?></td>
                <td class="align-middle">
                  <?= esc($order['order_price'] + $order['shipping'] - $order['discount_value']) ?> SEK för
                  <?= esc($order['quantity']) ?>
                  <?= $order['quantity'] <= 1 ? 'artikel' : 'artiklar' ?></td>
                <td class="text-end"><a class="btn btn-outline-info"
                    href="view-order/<?= esc($order['order_number']) ?>">Visa</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-5">
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
                <td class="text-end"><a class="btn btn-outline-info" href="#">Visa</a>
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
                  <button onclick="setProductSlug('<?= $product['slug'] ?>')" class="btn btn-outline-danger"
                    data-bs-toggle="modal" data-bs-target="#productModal"
                    data-product-slug="<?= $product['slug'] ?>">Radera</button>
                  <a class="btn btn-outline-info" href="/admin/editProduct/<?= $product['slug'] ?>">Redigera</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('group', 'front_full') ?>
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
                <td class="align-middle">1</td>
                <td class="text-end">
                  <button onclick="setProductSlug('<?= $sale['sale_name'] ?>')" class="btn btn-outline-danger"
                    data-bs-toggle="modal" data-bs-target="#saleModal"
                    data-product-slug="<?= $sale['sale_id'] ?>">Avsluta</button>
                  <a class="btn btn-outline-info" href="/admin/editSale/<?= $sale['sale_name'] ?>">Redigera</a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?= $pager->links('group2', 'front_full') ?>
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
              <a href="/admin/createDiscount" class="btn btn-outline-info">Skapa rabattkod</a>
            </div>
          </div>
          <!-- TODO Skapa tabell -->
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card overlay2 text-white shadow">
        <div class="card-body">
          <div class="row mb-2">
            <h2 class="card-title col">Kategorier</h2>
            <div class="col text-end">
              <a href="/admin/createCategory" class="btn btn-outline-info">Skapa kategori</a>
            </div>
          </div>
          <!-- TODO Skapa tabell -->
        </div>
      </div>
    </div>
  </div>
  <!-- /Rabatter och kategorier -->
</div>

<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ta bort produkt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Är du säker på att du vill ta bort produkten
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Avbryt</button>
        <a onclick="deleteProduct()" type="button" class="btn btn-danger">Ta bort</a>
      </div>
    </div>
  </div>
</div>

<!-- Sale Modal -->
<div class="modal fade" id="saleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Avsluta kampanj</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Är du säker på att du vill avsluta kampanjen
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Avbryt</button>
        <a onclick="endSale()" type="button" class="btn btn-danger">Avsluta</a>
      </div>
    </div>
  </div>
</div>

<script>
var productSlug;

function setProductSlug(slug) {
  productSlug = slug;
}

function deleteProduct() {
  window.location.replace(window.location.pathname + '/deleteProduct/' + productSlug);
}

function endSale() {
  window.location.replace(window.location.pathname + '/endSale/' + productSlug);
}
</script>

<?= $this->endSection() ?>