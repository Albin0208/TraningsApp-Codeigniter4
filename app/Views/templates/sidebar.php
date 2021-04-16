<?php $uri = service('uri'); ?>

<nav class="navbar navbar-dark navbar-expand-lg account-nav">
  <div class="collapse navbar-collapse account-nav bg-red mb-auto" id="navbarNava">
    <ul class="navbar-nav flex-column w-100 text-white">
      <li class="nav-item <?= $uri->getSegment(2) == "" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/user">Mitt konto</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
      <li class="nav-item <?= $uri->getSegment(2) == "orders" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/user/orders">Beställningar</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
      <li class="nav-item <?= $uri->getSegment(2) == "addresses" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/user/addresses">Adresser</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
      <li class="nav-item">
        <a class="nav-link ps-3 text-white" href="/logout">Logga ut</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
    </ul>
  </div>
</nav>