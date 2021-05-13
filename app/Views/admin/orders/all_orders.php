<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div class="bg-dark text-white p-3 shadow">
  <h2>Alla beställningarna</h2>
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
      <?php foreach($orders as $order) : ?>
      <tr>
        <th scope="row" class="align-middle"><a class="text-decoration-none text-info"
            href="<?= "/admin/orders/view/{$order['order_number']}" ?>">#<?= esc($order['order_number']) ?></a>
        </th>
        <td class="align-middle"><?= esc($time->parse($order['created_at'])->toDateString()) ?></td>
        <td class="align-middle">
          <?= esc($order['order_price'] + $order['shipping'] - $order['discount_value']) ?> SEK för
          <?= esc($order['quantity']) ?>
          <?= $order['quantity'] <= 1 ? 'artikel' : 'artiklar' ?></td>
        <td class="text-end"><a class="btn btn-outline-info"
            href="<?= "/admin/orders/view/{$order['order_number']}" ?>">Visa</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $pager->links('products', 'front_full') ?>
</div>

<?= $this->endSection() ?>