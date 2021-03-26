<?= $this->extend("layouts/userLayouts/userAccount") ?>
<?= $this->section('userPage') ?>

<table class="table text-white table-responsive">
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
      <th scope="row"><a class="text-decoration-none text-info"
          href="order/<?= esc($order['order_id']) ?>">#<?= esc($order['order_id']) ?></a></th>
      <td><?= esc($time->parse($order['created_at'])->toDateString()) ?></td>
      <td><?= esc($order['order_price']) ?> SEK för <?= esc($order['quantity']) ?>
        <?= $order['quantity'] <= 1 ? 'artikel' : 'artiklar' ?></td>
      <td class="text-end"><button class="btn btn-outline-info">Visa</button></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $pager->links('group', 'front_full') ?>

<?= $this->endSection() ?>