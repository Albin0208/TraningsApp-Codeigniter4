<?= $this->extend("layouts/main") ?>
<?= $this->section("content") ?>

<div id="carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true"
      aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="10000">
      <div class="container text-center p-3 text-white">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
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
</div>

<div class="text-white mt-4">
  <div class="row row-cols-1 gx-3">
    <div class="col col-sm-8">
      <div class="bg-dark shadow ap-3 h-100">
        <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia eligendi atque, velit et nulla dolorem ea
        explicabo esse, obcaecati sit reiciendis veniam alias totam officiis sapiente quidem ipsa, animi in sed cumque
        aliquam neque recusandae at laudantium! Quaerat quae esse ut, exercitationem non possimus quas a natus alias
        neque? Esse! -->
        <img src="https://tyngre.se/wp-content/uploads/2021/03/NOCCO-Mango-Del-SolStartsida-Banner.png" alt=""
          class="w-100 p-0">
      </div>
    </div>
    <div class="col col-sm-4">
      <div class="bg-dark p-3 shadow h-100">
        <?php if (session()->has('newsletter')) : ?>
        <div class="alert alert-success" role="alert">
          <?= session()->get('newsletter') ?>
        </div>
        <?php endif; ?>
        <h2><span class="fw-bold">Elit-Träning</span> Nyhetsbrev</h2>
        <hr class="mt-0" style="height: 3px;">
        <?= form_open(base_url() . '/Home/newsletterSignup', 'data-parsley-validate id="form_id" novalidate') ?>
        <div class="row gx-2">
          <div class="form-floating col-7 col-md-8">
            <input type="email" class="form-control border-custom overlay1" name="email"
              value="<?= @$user['email'] ?? set_value('email') ?>" id="email" placeholder="Email"
              data-parsley-errors-container="#invalidEmail" data-parsley-trigger="keyup change" required>
            <label for="email">Email adress</label>
            <div class="text-danger text-start" id="invalidEmail">
              <?= session()->get('error') ?>
            </div>
          </div>
          <div class="col">
            <input type="submit" class="btn btn-lg btn-outline-info w-100 h-100" value="Skicka">
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="bg-dark text-white mt-5 shadow">
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
</div>

<div class="bg-dark text-white mt-4 p-2">
  <h2 class="fw-bold mt-1">Nyheter i butiken</h2>
  <div class="row row-cols-2 row-cols-sm-4 p-2">
    <?php foreach ($products as $product) : ?>
    <?= view_cell('\App\Libraries\Shop::productItem', $product) ?>
    <?php endforeach; ?>
  </div>
</div>
</div>

<?= $this->endSection() ?>