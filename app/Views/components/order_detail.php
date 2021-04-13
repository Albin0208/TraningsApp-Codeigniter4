<tr>
  <td><a class="text-info text-decoration-none"
      href="<?= base_url() ?>/shop/product/<?= esc($product['slug']) ?>"><?= esc($product['name']) ?></a> <span
      class="fw-bold">x
      <?= esc($product['qty']) ?></span></td>
  <td><?= esc($product['price']) ?> SEK</td>
</tr>