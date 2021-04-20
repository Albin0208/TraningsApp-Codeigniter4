<!-- <nav class="navbar navbar-dark navbar-expand-lg account-nav">
  <div class="collapse navbar-collapse account-nav bg-red mb-auto" id="navbarNava">
    <ul class="navbar-nav flex-column w-100 text-white p-2">
      <li>
        <div class="col">
          <p>Kategorier</p>
          <a href="">Dryck</a>
        </div>
      </li>
    </ul>
  </div>
</nav> -->
<?php $uri = service('uri'); ?>

<nav class="navbar navbar-dark navbar-expand-lg account-nav">
  <div class="collapse navbar-collapse account-nav bg-red mb-auto text-white d-flex flex-column p-2" id="navbarNava">
    <h5 class="text-start">Kategorier</h5>
    <ul class="navbar-nav flex-column w-100 text-white">
      <li class="nav-item <?= $uri->getSegment(2) == "" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/shop">Allt</a>
      </li>
      <li class="nav-item <?= $uri->getSegment(2) == "e-bok" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/shop/e-bok">E-bok</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
      <li class="nav-item <?= $uri->getSegment(2) == "dryck" ? "active" : null ?>">
        <a class="nav-link ps-3 text-white" href="/shop/dryck">Dryck</a>
      </li>
      <hr class="m-0 ms-3 me-3 align-self-center">
    </ul>
  </div>
</nav>