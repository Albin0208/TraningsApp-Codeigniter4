<!DOCTYPE html>
<html lang="sv">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= @$title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
  <?php $uri = service('uri'); ?>
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom bg-reda fixed-top">
    <div class="container">
      <a class="navbar-brand brand" href="/">Elit-Träning</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link ps-2 <?= $uri->getSegment(1) == "" ? "active" : null ?>" href="/">Startsida</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-2 <?= $uri->getSegment(1) == "shop" ? "active" : null ?>" href="/shop">Butik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ps-2 <?= $uri->getSegment(1) == "about" ? "active" : null ?>" href="#">Om
              Elit-Träning</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <?php if (session()->get('isLoggedIn')) : ?>
            <a href="/user" class="nav-link ps-2 <?= $uri->getSegment(1) == "user" ? "active" : null ?>">
              <i class="bi bi-person-fill" style="font-size: 20px;"></i>
              Mitt Konto
            </a>
            <?php else : ?>
            <a href="/login" class="nav-link ps-2 <?= $uri->getSegment(1) == "login" ? "active" : null ?>">
              <i class="bi bi-person-fill" style="font-size: 20px;"></i>
              Logga in</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a href="/cart" class="nav-link ps-2 <?= $uri->getSegment(1) == "cart" ? "active" : null ?>">
              <span class="cart-wrapper">
                <i class="bi bi-cart3" style="font-size: 20px;"></i>
                <span class="badge rounded-pill bg-primary text-white cart-badge">
                  <?php $cart = service('cart'); echo $cart->totalItems(); ?>
                </span>
              </span>
              Varukorg
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-lg my-4 mb-5 p-0">
    <?php $this->renderSection("content") ?>
  </div>
  <footer class="text-white p-4 pt-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-4 me-auto">
          <h4 class="text-uppercase fw-bold">Om Elit-träning</h4>
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatibus eos suscipit accusamus minima animi
            quasi sapiente impedit, quae nam porro.</p>
        </div>
        <div class="col-6 col-sm-3">
          <h4 class="text-uppercase fw-bold">Support</h4>
          <ul class="footer-list">
            <li>
              <a href="/terms-and-conditions">Allmänna villkor</a>
            </li>
            <li>
              <a href="mailto:">Maila oss</a>
            </li>
            <li>
              <a href="tel:+">0712 34 56 78</a>
            </li>
          </ul>
        </div>
        <div class="col-6 col-sm-3">
          <h4 class="text-uppercase fw-bold">Meny</h4>
          <ul class="footer-list">
            <li>
              <a href="/">Startsida</a>
            </li>
            <li>
              <a href="/shop">Butik</a>
            </li>
          </ul>
        </div>
        <div class="col-12 text-muted">
          <span>&COPY; Copyright 2021 - Elit-Träning</span>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"
    integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ=="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous"></script>
  <script src="/assets/js/parsley.js"></script>
</body>

</html>