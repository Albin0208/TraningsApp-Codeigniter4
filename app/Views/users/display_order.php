<?= $this->extend("users/account") ?>
<?= $this->section('userPage') ?>

<div class="bg-dark text-white">
  <h5>Beställning nr <?= esc($orderDetails['order_number']) ?> gjordes
    <?= esc($time->parse($orderDetails['created_at'])->toDateString()) ?></h5>
  <section class="mt-4 mb-5">
    <h3 class="text-start text-info">Orderdetaljer</h3>
    <table class="table text-white">
      <thead>
        <tr>
          <th scope="col">Produkt</th>
          <th scope="col">Summa</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($orderItems as $item) : ?>
        <?= view_cell('App\Libraries\OrderItems::orderDetails', $item) ?>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <?php if ($orderDetails['discount_value'] > 0) : ?>
        <tr>
          <td class="fw-bold">Rabatt:</td>
          <td><span class="text-danger">-<?= esc($orderDetails['discount_value']) ?></span> SEK</td>
        </tr>
        <?php endif; ?>
        <tr>
          <td class="fw-bold">Frakt:</td>
          <td><?= $orderDetails['shipping'] == 0 ? 'Gratis' : esc($orderDetails['shipping']) . ' SEK' ?></td>
        </tr>
        <tr>
          <td class="fw-bold">Totalt:</td>
          <td><?= esc($orderDetails['order_price'] + $orderDetails['shipping'] - $orderDetails['discount_value'])?> SEK
          </td>
        </tr>
      </tfoot>
    </table>
  </section>
  <section class="row">
    <div class="col">
      <h4 class="text-info">Faktureringsadress</h4>
      <address>
        <?= esc($orderDetails['firstname']) ?> <?= esc($orderDetails['lastname']) ?> <br>
        <?= esc($orderDetails['address']) ?> <br>
        <?= esc($orderDetails['zip_code']) ?> <?= esc($orderDetails['city']) ?> <br>
        <?= esc($orderDetails['phone']) ?> <br>
        <?= esc($orderDetails['email']) ?>
      </address>
    </div>
    <div class="col">
      <h4 class="text-info">Leveransadress</h4>
      <address>
        <?= esc($orderDetails['firstname']) ?> <?= esc($orderDetails['lastname']) ?> <br>
        <?= esc($orderDetails['address']) ?> <br>
        <?= esc($orderDetails['zip_code']) ?> <?= esc($orderDetails['city']) ?> <br>
      </address>
    </div>
  </section>
</div>

<?= $this->endSection() ?>