<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<!-- News Carousel -->
<section id="carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <div class="container text-center p-3 text-white my-auto">
        <h3>Pågående kampanjer</h3>
        <ul class="list-unstyled mb-4">
          <?php if (!empty($sales)) : ?>
          <?php foreach($sales as $sale) : ?>
          <li><?= $sale['sale_name'] ?></li>
          <?php endforeach; ?>
          <?php else : ?>
          <li>Just nu finns det inga kampanjer</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h3>Familia Del Sol</h3>
        <div class="row">
          <?php foreach($noccos as $nocco) : ?>
          <div class="col">
            <a href="<?= "/shop/product/{$nocco['slug']}" ?>">
              <img src="<?= $nocco['image'] ?>" class="img-fluid w-75">
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <img src="https://tyngre.se/wp-content/uploads/2021/03/NOCCO-Mango-Del-SolStartsida-Banner.png" alt=""
          class="img-fluid">
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</section>
<!-- /News Carousel -->

<section class="text-white mt-4">
  <div class="row row-cols-1 gx-3">
    <div class="col col-sm-8">
      <div class="shadow">
        <img src="https://tyngre.se/wp-content/uploads/2021/03/NOCCO-Mango-Del-SolStartsida-Banner.png" alt=""
          class="w-100 p-0">
      </div>
    </div>
    <div class="col col-sm-4 mt-4 mt-sm-0">
      <div class="bg-dark p-3 shadow h-100">
        <?php if (session()->has('newsletter')) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->get('newsletter') ?>
        </div>
        <?php elseif (session()->has('newsletterError')) : ?>
        <div class="alert alert-danger" role="alert">
          <?= session()->get('newsletterError') ?>
        </div>
        <?php endif; ?>
        <h4><span class="fw-bold">Elit-Träning</span> Nyhetsbrev</h4>
        <hr class="mt-0" style="height: 3px;">
        <?= form_open(base_url('/home/newsletterSignup'), 'data-parsley-validate id="form_id" novalidate') ?>
        <div class="row gx-2">
          <div class="form-floating col-12 col-lg-8">
            <input type="email" class="form-control border-custom overlay1" name="email"
              value="<?= @$user['email'] ?? set_value('email') ?>" id="email" placeholder="Email"
              data-parsley-errors-container="#invalidEmail" data-parsley-trigger="keyup change" required>
            <label for="email">Email adress</label>
            <div class="text-danger text-start" id="invalidEmail">
              <?= session()->get('error') ?>
            </div>
          </div>
          <div class="col-12 col-lg-4 mt-2 mt-lg-0">
            <input type="submit" class="btn btn-lg btn-outline-info w-100 h-100" value="Skicka">
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>

<!-- Info row -->
<section class="bg-dark text-white mt-5 shadow">
  <div class="row row-cols-1 row-cols-md-3 text-center p-3">
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Leverans inom 1-3 arbetsdagar</span>
    </div>
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Fri frakt vid köp över 500 SEK</span>
    </div>
    <div class="col">
      <i class="bi bi-check-circle me-1"></i>
      <span class="align-middle">Fria byten</span>
    </div>
  </div>
</section>
<!-- /Info row -->

<!-- News display -->
<section class="bg-dark text-white mt-4 p-2">
  <h2 class="fw-bold mt-1">Nyheter i butiken</h2>
  <div class="row row-cols-2 row-cols-sm-4 p-2">
    <?php foreach ($products as $product) : ?>
    <?= view_cell('\App\Libraries\Shop::productItem', $product) ?>
    <?php endforeach; ?>
  </div>
</section>
<!-- /News display -->

<?= $this->endSection() ?>