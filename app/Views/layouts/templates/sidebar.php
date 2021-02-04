<?php $uri = service('uri'); ?>
<div class="bg-red col-2 account-nav">
  <ul class="navbar-nav">
    <li class="nav-item <?= $uri->getSegment(2) == "" ? "active" : null ?>">
      <a class="nav-link ps-3" href="/user">Profil</a>
    </li>
    <hr class="m-0 ms-3 me-3 align-self-center">
    <li class="nav-item <?= $uri->getSegment(2) == "orders" ? "active" : null ?>">
      <a class="nav-link ps-3" href="/user/orders">Beställningar</a>
    </li>
    <hr class="m-0 ms-3 me-3 align-self-center">
    <li class="nav-item <?= $uri->getSegment(2) == "programs" ? "active" : null ?>">
      <a class="nav-link ps-3" href="/user/programs">Mina program</a>
    </li>
    <hr class="m-0 ms-3 me-3 align-self-center">
    <li class="nav-item">
      <a class="nav-link ps-3" href="/logout">Logga ut</a>
    </li>
    <hr class="m-0 ms-3 me-3 align-self-center">
  </ul>
</div>