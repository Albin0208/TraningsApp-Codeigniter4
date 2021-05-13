<tr>
  <td><a class="text-info text-decoration-none"
      href="<?= "/shop/product/{$product['slug']}" ?>"><?= esc($product['name']) ?></a> <span class="fw-bold">x
      <?= esc($product['qty']) ?></span></td>
  <td><?= esc($product['price']) ?> SEK</td>
</tr>