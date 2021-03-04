<?php

$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
  <ul class="pager pagination justify-content-center">
    <li class="page-item <?= !$pager->hasPreviousPage() ? 'disabled' : '' ?>">
      <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Föregående">
        <span aria-hidden="true">Föregående</span>
      </a>
    </li>

    <?php foreach ($pager->links() as $link) : ?>
    <li <?= $link['active']  ? 'class="page-item active"' : '' ?>>
      <a class="page-link" href="<?= $link['uri'] ?>">
        <?= $link['title'] ?>
      </a>
    </li>
    <?php endforeach ?>

    <li class="page-item <?= !$pager->hasNextPage() ? 'disabled' : '' ?>">
      <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Nästa>">
        <span aria-hidden="true">Nästa</span>
      </a>
    </li>
  </ul>
</nav>